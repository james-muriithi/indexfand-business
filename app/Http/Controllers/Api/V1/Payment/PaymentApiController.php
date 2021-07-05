<?php

namespace App\Http\Controllers\Api\V1\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\InitiatePaymentRequest;
use App\Models\StkRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Safaricom\Mpesa\Mpesa;

class PaymentApiController extends Controller
{
    public function initiate(InitiatePaymentRequest $request)
    {
        $request->merge([
            'phone' => preg_replace('/^(0|\+?254)/', '254', $request->input('phone'))
        ]);

        //initiate stk push
        $mpesa = new Mpesa();
        $BusinessShortCode = '4030551';
        $LipaNaMpesaPasskey = env('LNMO_PASSKEY');
        $Timestamp = date('YmdHis');

        $Password = base64_encode($BusinessShortCode . $LipaNaMpesaPasskey . $Timestamp);

        $TransactionType = 'CustomerPayBillOnline';
        $Amount = 1;
        $PartyA = $request->input('phone');
        $PartyB = $BusinessShortCode;
        $PhoneNumber = $request->input('phone');
        $CallBackURL = env('APP_ENV') == 'production' ?
            route('api.c2b.response', env('CALLBACK_KEY')) : 'https://google.com';
        $AccountReference = $request->input('account');
        $TransactionDesc = $request->input('account');
        $Remarks = $request->input('account');
        $stkPushSimulation = $mpesa->STKPushSimulation($BusinessShortCode, $LipaNaMpesaPasskey, $TransactionType,
            $Amount, $PartyA, $PartyB, $PhoneNumber, $CallBackURL, $AccountReference, $TransactionDesc, $Remarks);

        $temp = json_decode($stkPushSimulation, true);

        if (isset($temp['errorMessage']) || (isset($temp['ResponseCode']) && $temp['ResponseCode'] != 0)) {
            return response()->json([
                'status' => 0,
                'message' => $temp['errorMessage']
            ]);
        } elseif (isset($temp['ResponseCode'])) {
            StkRequest::create([
                'RequestId' => $temp['CheckoutRequestID'],
                'MSISDN' => $request->input('phone'),
                'BillRefNumber' => $AccountReference,
                'Amount' => $Amount,
                'business_callback_url' => $request->input('callBackUrl'),
            ]);
            return response()->json([
                'status' => 1,
                'requestID' => $temp['CheckoutRequestID'],
                'message' => $temp['ResponseDescription'],
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'An unexpected error occurred.',
            ]);
        }
    }

    public function callback(Request $request, $token)
    {
        if ($token && $token == env('CALLBACK_KEY')) {
            $response = json_decode($request->all(), true);

            try {
                $code = $response['Body']['stkCallback']['ResultCode'];
                $description = $response['Body']['stkCallback']['ResultDesc'];
                $requestId = $response['Body']['stkCallback']['CheckoutRequestID'];

                $stkRequest = StkRequest::where('RequestId', $requestId)->first();

                if ($code == 0) {
                    $amount = $response['Body']['stkCallback']['CallbackMetadata']['Item'][0]['Value'];
                    $receipt = $response['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'];
                    $phone = $response['Body']['stkCallback']['CallbackMetadata']['Item'][4]['Value'];

                    if ($stkRequest){
                        $stkRequest->paid = 1;
                        $stkRequest->save();
                    }

                    if ($stkRequest && $stkRequest->business_callback_url) {
                        Http::acceptJson()
                            ->post($stkRequest->business_callback_url, [
                            'status' => 1,
                            'message' => 'Transaction was successful.',
                            'amount' => $amount,
                            'paid_by' => $phone,
                            'receipt' => $receipt,
                        ]);
                    }

                } else {
                    if ($stkRequest && $stkRequest->business_callback_url) {
                        Http::acceptJson()
                            ->post($stkRequest->business_callback_url, [
                                'status' => 1,
                                'message' => $description,
                                'amount' => null,
                                'paid_by' => null,
                                'receipt' => null,
                            ]);
                    }
                }
            } catch (\Exception $exception) {
                Log::error($exception);
            }

        }
    }

    public function STKPushQuery()
    {
        
    }
}

<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\B2cResponse;
use App\Models\Withdraw;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CallbackApiController extends Controller
{
    public function response(Request $request, $token)
    {
        Storage::append('b2c/response.json', json_encode($request->all()));

        if ($token && $token == env('CALLBACK_KEY')){
            $response = json_decode(json_encode($request->all()), true);

            $code = $response['Result']['ResultCode'];
            $ConversationId = $response['Result']['ConversationID'];
            $OriginatorConversationId = $response['Result']['OriginatorConversationID'];
            $TransactionId = $response['Result']['TransactionID'];

            if ($code == 0){
                $resultParameters = $response['Result']['ResultParameters'];
                $amount = floatval($resultParameters['ResultParameter'][0]['Value']);
                $publicName = $resultParameters['ResultParameter'][2]['Value'];
                $time = $resultParameters['ResultParameter'][3]['Value'];
                $utility = $resultParameters['ResultParameter'][4]['Value'];
                $working = $resultParameters['ResultParameter'][5]['Value'];

                B2cResponse::create([
                    'ConversationID' => $ConversationId,
                    'OriginatorConversationID' => $OriginatorConversationId,
                    'TransactionId' => $TransactionId,
                    'TransactionAmount' => $amount,
                    'ReceiverPartyPublicName' => $publicName,
                    'B2CUtilityAccountAvailableFunds' => floatval($utility),
                    'B2CWorkingAccountAvailableFunds' => floatval($working),
                    'TransactionCompletedDateTime' => $time,
                ]);

                $withdrawRequest = WithdrawRequest::with('business')
                    ->where('ConversationID', $ConversationId)->first();

                if ($withdrawRequest && $withdrawRequest->business){
                    $phone = preg_replace('/^(0|\+?254)/', '+254',array_filter(explode(' - ', $publicName))[0]);

                    if (!Withdraw::isDuplicateWithdraw($amount, $withdrawRequest->business->id)){
                        $withdrawRequest->status = 1;
                        $withdrawRequest->save();

                        Withdraw::create([
                            'business_id' => $withdrawRequest->business->id,
                            'phone' => $phone,
                            'amount' => $amount,
                            'status' => 1,
                        ]);
                        $withdrawRequest->business->balance =  $withdrawRequest->business->balance - $amount;
                        $withdrawRequest->save();
                    }
                }
            }

        }
    }

    public function timeout(Request $request)
    {
        Storage::append('b2c/timeout.json', json_encode($request->all()));
    }
}

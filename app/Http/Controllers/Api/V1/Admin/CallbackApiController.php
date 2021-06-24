<?php

namespace App\Http\Controllers\Api\V1\Admin;

use AfricasTalking\SDK\AfricasTalking;
use App\Http\Controllers\Controller;
use App\Http\Helpers\B2cMpesa;
use App\Models\B2cResponse;
use App\Models\Withdraw;
use App\Models\WithdrawRequest;
use App\Notifications\WithdrawNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CallbackApiController extends Controller
{
    public const LOW_UTILITY_BALANCE = 6000;
    public function response(Request $request, $token)
    {
        Storage::append('b2c/response.json', json_encode($request->all()));

        if ($token && $token == env('CALLBACK_KEY')){
            $response = json_decode(json_encode($request->all()), true);

            $code = $response['Result']['ResultCode'];
            $ConversationId = $response['Result']['ConversationID'];
            $OriginatorConversationId = $response['Result']['OriginatorConversationID'];
            $TransactionId = $response['Result']['TransactionID'];

            $withdrawRequest = WithdrawRequest::with('business')
                ->where('ConversationID', $ConversationId)->first();

            if ($code == 0){
                $resultParameters = $response['Result']['ResultParameters'];
                $amount = floatval($resultParameters['ResultParameter'][0]['Value']);
                $publicName = $resultParameters['ResultParameter'][2]['Value'];
                $time = $resultParameters['ResultParameter'][3]['Value'];
                $utility = $resultParameters['ResultParameter'][4]['Value'];
                $working = $resultParameters['ResultParameter'][5]['Value'];

                if ($withdrawRequest && $withdrawRequest->business){
                    $phone = preg_replace('/^(0|\+?254)/', '+254',array_filter(explode(' - ', $publicName))[0]);

//                    if (!Withdraw::isDuplicateWithdraw($amount, $withdrawRequest->business->id) && !$withdrawRequest->responded){
                    if (!$withdrawRequest->responded){
                        $withdrawRequest->responded = 1;
                        $withdrawRequest->save();

                        $withdrawRequest->status = 1;
                        $withdrawRequest->save();

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

                        $withdraw = Withdraw::create([
                            'business_id' => $withdrawRequest->business->id,
                            'phone' => $phone,
                            'amount' => $amount,
                            'status' => 1,
                        ]);

                        $withdrawRequest->business->balance =  $withdrawRequest->business->balance -($amount + B2cMpesa::TRANSACTION_COST);
                        $withdrawRequest->business->save();

                        //send sms
                        $message = 'Ksh. '.$amount. ' has been withdrawn from '.$withdrawRequest->business->name.
                            ' to your M-Pesa. New balance is Ksh '.$withdrawRequest->business->balance.
                            '. M-PESA Ref '.$TransactionId.PHP_EOL.'#indexfand';
                        $this->sendMessage($phone, $message);

                        $withdrawRequest->business->businessOwner->notify(new WithdrawNotification($withdraw, $message));

                        // if low balance
                        if ((int)$utility < self::LOW_UTILITY_BALANCE){
                            $email = 'patrieno55@gmail.com';
                            $phone = '254798272066';
                            $subject = 'Courtesy Balance Notification';

                            $mesage = 'This is to inform you that your credit level on Mpesa is now lower than your threshold amount.'.PHP_EOL
                                .' Current Balance - KES '.$utility.'.';
                            $emailMessage = $this->generateEmailMessage($utility, $working);

                            $this->sendMessage($phone, $mesage);

                            Mail::send([], [], function ($message) use ($email, $emailMessage, $subject){
                                $message->to($email)
                                    ->subject($subject)
                                    ->setBody($emailMessage, 'text/html');
                            });
                        }

                    }
                }else{
                    //hope this never happens
                    $msg = $publicName.' just withdrew Ksh. '.$amount.' and they dont have a registered business.'.PHP_EOL.'#indexfand';
                    $this->sendMessage('+254798272066', $msg);
                }
            }else{
                if ($withdrawRequest && $withdrawRequest->business &&
                    !$withdrawRequest->responded){
                    $withdrawRequest->responded = 1;
                    $withdrawRequest->save();

                    $phone = preg_replace('/^(0|\+?254)/', '+254',
                        array_filter(explode(' - ', $withdrawRequest->business->contact))[0]);

                    $message = 'We are experiencing problems with withdraw at the moment. Please try again later.'
                        .PHP_EOL.'#indexfand';
                    $this->sendMessage($phone, $message);

                    $errMsg = 'A withdraw from business '.$withdrawRequest->business->name.' was tried but an error occurred.'.PHP_EOL.
                        'Error => '.$response['Result']['ResultDesc'];

                    $this->sendMessage('+254798272066', $errMsg);

                    $withdrawRequest->business->businessOwner->notify(new WithdrawNotification($withdrawRequest, $message, true));
                }
            }

        }
    }

    public function timeout(Request $request)
    {
        Storage::append('b2c/timeout.json', json_encode($request->all()));
    }

    public function sendMessage($phone, $message)
    {
        $username = env('AT_USERNAME'); // use 'sandbox' for development in the test environment
        $apiKey   = env('AT_API_KEY'); // use your sandbox app API key for development in the test environment
        $AT       = new AfricasTalking($username, $apiKey);

        // Get one of the services
        $sms      = $AT->sms();

        // Use the service
        return $sms->send([
            'to'      => $phone,
            'message' => $message
        ]);
    }


    public function generateEmailMessage($balance, $working){
        return "<html>
            <head>
              <title></title>
              <style>
                html,
                body{
                  font-family: Arial, Helvetica, sans-serif;
                }
              </style>
            </head>
            <body>
              <div style=3D'padding: 10px 16px; line-height: 1.6; font-size: 16px;'>
                <p>Hi Patrick,</p>
                <p>This is to inform you that your credit level on <b>Mpesa</b> is now lower than your threshold amount.</p>
                <p><b>Current Balance - KES ".$balance."</b><br>
                <b>Threshold Amount - KES ".LOW_UTILITY_BALANCE."</b><br>
                <b>Working Account Balance: ".$working."</b></p>
                <p>Regards,</p>
                <p>Indexfand Team</p>
              </div>
            </body>
          </html>";
    }
}

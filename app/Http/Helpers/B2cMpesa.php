<?php


namespace App\Http\Helpers;


use Safaricom\Mpesa\Mpesa;

class B2cMpesa extends Mpesa
{
    const TRANSACTION_COST = 20;
    public static function generateLiveToken()
    {
        try {
            $consumer_key = env("MPESA_B2C_CONSUMER_KEY");
            $consumer_secret = env("MPESA_B2C_CONSUMER_SECRET");
        } catch (\Throwable $th) {
            $consumer_key = self::env("MPESA_B2C_CONSUMER_KEY");
            $consumer_secret = self::env("MPESA_B2C_CONSUMER_SECRET");
        }

        if(!isset($consumer_key)||!isset($consumer_secret)){
            die("please declare the consumer key and consumer secret as defined in the documentation");
        }
        $url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        $credentials = base64_encode($consumer_key.':'.$consumer_secret);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials)); //setting a custom header
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $curl_response = curl_exec($curl);

        return json_decode($curl_response)->access_token;
    }

    public static function b2c($InitiatorName, $SecurityCredential, $CommandID, $Amount, $PartyA, $PartyB, $Remarks, $QueueTimeOutURL, $ResultURL, $Occasion){

        try {
            $environment = env("MPESA_ENV");
        } catch (\Throwable $th) {
            $environment = self::env("MPESA_ENV");
        }

        if( $environment =="live"){
            $url = 'https://api.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';
            $token=self::generateLiveToken();
        }elseif ($environment=="sandbox"){
            $url = 'https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';
            $token=self::generateSandBoxToken();
        }else{
            return json_encode(["Message"=>"invalid application status"]);
        }


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$token));


        $curl_post_data = array(
            'InitiatorName' => $InitiatorName,
            'SecurityCredential' => $SecurityCredential,
            'CommandID' => $CommandID ,
            'Amount' => $Amount,
            'PartyA' => $PartyA ,
            'PartyB' => $PartyB,
            'Remarks' => $Remarks,
            'QueueTimeOutURL' => $QueueTimeOutURL,
            'ResultURL' => $ResultURL,
            'Occasion' => $Occasion
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);

        return $curl_response;

    }

    public static function generateSecurityCredential(){
        $pubkey = file_get_contents('https://developer.safaricom.co.ke/sites/default/files/cert/cert_prod/cert.cer');
        $plaintext = env('INITIATOR_PASSWORD', '');
        openssl_public_encrypt($plaintext, $encrypted, $pubkey, OPENSSL_PKCS1_PADDING);
        return base64_encode($encrypted);
    }
}

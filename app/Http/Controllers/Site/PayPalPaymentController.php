<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\AdaptivePayments;
use Illuminate\Support\Str;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

class PayPalPaymentController extends Controller
{
    public $API_URL;
    public $CLIENT_ID;
    public $CLIENT_SECRET;


    public function __construct()
    {
        $this->API_URL = "https://api-m.sandbox.paypal.com";
        $this->CLIENT_ID = "ARVtcZetyA8oRfMQm_Da4gt7LBa33cHSUFSkHKnhQlmQOZhgR-Jqrc7AEikRGzP99I3rz_PzsAn4OUIK";
        $this->CLIENT_SECRET = "EH3zbu9-x0VxIsAn8BdUU-JzMBcoG7aFf6XacaAsL24_kLjgF_OeE3EIgin3pMYnLRH3y2RksARYU6tN";
    }


   public function getToken()
   {
        $API_URL = $this->API_URL;
        $CLIENT_ID = $this->CLIENT_ID;
        $CLIENT_SECRET = $this->CLIENT_SECRET;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "$API_URL/v1/oauth2/token");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        curl_setopt($ch, CURLOPT_USERPWD, "$CLIENT_ID:$CLIENT_SECRET");

        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Accept-Language: en_US';
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        $curlErr  = curl_error($ch);
    
        curl_close($ch);

        if ($curlErr) {
            //Curl is not working in your server
            dd("Curl Error: $curlErr");
        }

        $resualt = json_decode($response);

        // $scope = $resualt->scope ; 
        // $access_token =  $resualt->access_token ;   
        // $token_type =  $resualt->token_type ;   
        // $app_id =    $resualt->app_id ; 
        // $expires_in =    $resualt->expires_in ; 
        // $nonce =    $resualt->nonce ; 


        session()->put('paypal_token',json_decode($response)->access_token);

        // return json_decode($response)->access_token;
        return redirect()->back();
   }

   
   public function captureAuthorizedPayment()
   {
       // returns error :
        /*"{
            "name":"AUTHENTICATION_FAILURE",
            "message":"Authentication failed due to invalid authentication credentials or a missing Authorization header.",
            "links":[{"href":"https://developer.paypal.com/docs/api/overview/#error",
                "rel":"information_link"}
                ]}"
        */

       $postFields = [
           'amount'=> [
               'value'=> 10.99,
               'currency_code'=> 'USD'
            ],
            // 'invoice_id'=> 'INVOICE-123',
            'final_capture'=> true
        ];

        // dd(json_encode($postFields) );

        // Paypal-Request-Id header value must be unique for both each request and an API call type
        // $uuid = Str::uuid()->toString();
    
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "$this->API_URL/v2/payments/authorizations/0VF52814937998046/capture");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,'{"amount":{"value":10.99,"currency_code":"USD"},"final_capture":true}' );

        // $headers = array();
        // $headers[] = 'Content-Type: application/json';
        // $headers[] = "Authorization: Bearer" .session('paypal_token');
        // $headers[] = "Paypal-Request-Id: 123e4567-e89b-12d3-a456-426655440010";
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',"Authorization: Bearer" .session('paypal_token'), "Paypal-Request-Id: 123e4567-e89b-12d3-a456-426655440010"));

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' .json_decode(curl_error($ch));
        }

        dd($result);
        curl_close($ch);

   }

   public function checkout()
   {
        $API_URL = $this->API_URL;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "$API_URL/v2/checkout/orders");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{intent: CAPTURE,purchase_units: [ { amount: {  currency_code: USD, value:100.00   } }  ] }");

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',"Authorization: Bearer" .session('paypal_token'), "Paypal-Request-Id: 123e4567-e89b-12d3-a456-426655440010"));
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);



        $result = curl_exec($ch);
        dd( $result );
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
   }
  
   
}

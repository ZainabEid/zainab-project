<?php

namespace App\Services\Payment;

use App\Services\Payment\Contract\PaymentInterface;
use Illuminate\Http\Request;

class FatoorahServices implements PaymentInterface
{

    protected  $apiURL;
    protected  $apiKey;

    public function __construct()
    {
        // fatoorah api configrations
        $this->apiURL = 'ARVtcZetyA8oRfMQm_Da4gt7LBa33cHSUFSkHKnhQlmQOZhgR-Jqrc7AEikRGzP99I3rz_PzsAn4OUIK';
        $this->apiKey = config('app.API_KEY');
    }


    public  function getInvoiceLink($NotificationOption, $InvoiceValue, $CustomerName)
    {

        // collect invoice data
        $postFields = [
            'NotificationOption' => $NotificationOption, //'SMS', 'EML', or 'ALL'
            'InvoiceValue'       => $InvoiceValue,
            'CustomerName'       => $CustomerName,
        ];

        //Call endpoint
        $data = $this->sendPayment($this->apiURL, $this->apiKey, $postFields);

        //returned links

        return [
            'invoiceId' => $data->InvoiceId,
            'paymentLink' => $data->paymentLink, // error
        ];
    }


    public  function getPaymentMethod($InvoiceAmount, $CurrencyIso)
    {

        //Fill POST fields array
        $ipPostFields = [
            'InvoiceAmount' => $InvoiceAmount,
            'CurrencyIso'   => $CurrencyIso
        ];

        //Call endpoint
        $paymentMethods = $this->initiatePayment($this->apiURL, $this->apiKey, $ipPostFields);

        return  $paymentMethods;
    } // end of get payment method



    public  function getPaymentLink(
        $PaymentMethodId,
        $InvoiceValue,
        $CallBackUrl = "route('site.payment.CallBack')",
        $ErrorUrl = "route('site.payment.CallBack')") 
    {

        $postFields = [
            //Fill required data
            'paymentMethodId' => $PaymentMethodId,
            'InvoiceValue'    => $InvoiceValue,
            'CallBackUrl'     => $CallBackUrl,
            'ErrorUrl'        => $ErrorUrl,
        ];


        //Call endpoint
        $data = $this->executePayment($this->apiURL, $this->apiKey, $postFields);
        return $data;
    } // end of get payment link


    public  function getPaymentCallBack(Request $request)
    {

        //Inquiry using paymentId
        $keyId   = $request->paymentId;
        $KeyType = 'paymentId';

        $Data = $this->getPaymentData($this->apiURL, $this->apiKey, $keyId, $KeyType);

        return $Data;
    } // end of get payment data


    public function getPaymentStatus($keyId, $KeyType = 'paymentId')
    {
        // to return inProgress make Type invoiceId
        $Data = $this->getPaymentData($this->apiURL, $this->apiKey, $keyId, $KeyType);

        return $Data->InvoiceStatus; // InProgress | pending | Paid  
    }






    /* ------------------------ Functions --------------------------------------- */

    /*
    * Send Payment Endpoint Function 
    */

    public function sendPayment($apiURL, $apiKey, $postFields)
    {
        $json = $this->callAPI("$apiURL/v2/SendPayment", $apiKey, $postFields);
        return $json->Data;
    }

    /*
    * Initiate Payment Endpoint Function 
    */

    function initiatePayment($apiURL, $apiKey, $postFields)
    {

        $json = $this->callAPI("$apiURL/v2/InitiatePayment", $apiKey, $postFields);
        return $json->Data->PaymentMethods;
    }

    //------------------------------------------------------------------------------
    /*
    * Execute Payment Endpoint Function 
    */

    function executePayment($apiURL, $apiKey, $postFields)
    {

        $json = $this->callAPI("$apiURL/v2/ExecutePayment", $apiKey, $postFields);
        return $json->Data;
    }

    function getPaymentData($apiURL, $apiKey, $keyId, $KeyType)
    {
        $postFields = [
            'Key'     => $keyId,
            'KeyType' => $KeyType
        ];

        $json  = $this->callAPI("$apiURL/v2/getPaymentStatus", $apiKey, $postFields);
        return $json->Data;
    }

    //------------------------------------------------------------------------------
    /*
    * Call API Endpoint Function
    */

    function callAPI($endpointURL, $apiKey, $postFields = [], $requestType = 'POST')
    {

        $curl = curl_init($endpointURL);
        curl_setopt_array($curl, array(
            CURLOPT_CUSTOMREQUEST  => $requestType,
            CURLOPT_POSTFIELDS     => json_encode($postFields),
            CURLOPT_HTTPHEADER     => array("Authorization: Bearer $apiKey", 'Content-Type: application/json'),
            CURLOPT_RETURNTRANSFER => true,
        ));

        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($curl);
        $curlErr  = curl_error($curl);

        curl_close($curl);

        if ($curlErr) {
            //Curl is not working in your server
            die("Curl Error: $curlErr");
        }

        $error = $this->handleError($response);
        if ($error) {
            die("Error: $error");
        }

        return json_decode($response);
    }

    //------------------------------------------------------------------------------
    /*
    * Handle Endpoint Errors Function 
    */

    function handleError($response)
    {

        $json = json_decode($response);
        if (isset($json->IsSuccess) && $json->IsSuccess == true) {
            return null;
        }

        //Check for the errors
        if (isset($json->ValidationErrors) || isset($json->FieldsErrors)) {
            $errorsObj = isset($json->ValidationErrors) ? $json->ValidationErrors : $json->FieldsErrors;
            $blogDatas = array_column($errorsObj, 'Error', 'Name');

            $error = implode(', ', array_map(function ($k, $v) {
                return "$k: $v";
            }, array_keys($blogDatas), array_values($blogDatas)));
        } else if (isset($json->Data->ErrorMessage)) {
            $error = $json->Data->ErrorMessage;
        }

        if (empty($error)) {
            $error = (isset($json->Message)) ? $json->Message : (!empty($response) ? $response : 'API key or API URL is not correct');
        }

        return $error;
    }

    /* -------------------------------------------------------------------------- */
}

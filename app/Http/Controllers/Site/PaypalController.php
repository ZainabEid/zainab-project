<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;
use Omnipay\Omnipay;

class PaypalController extends Controller
{
    
    public $gateway;
  
    public function __construct()
    {
       
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->initialize([
            'clientId' => 'ARVtcZetyA8oRfMQm_Da4gt7LBa33cHSUFSkHKnhQlmQOZhgR-Jqrc7AEikRGzP99I3rz_PzsAn4OUIK',
            'secret'   => 'EH3zbu9-x0VxIsAn8BdUU-JzMBcoG7aFf6XacaAsL24_kLjgF_OeE3EIgin3pMYnLRH3y2RksARYU6tN',
            'testMode' => true,]);
            // dd($this->gateway);

    }
  
    public function index()
    {
        return view('site.payment');
    }
  
    public function charge($amount)
    {

        if($amount)
        {
            try {
                // $this->gateway->setSslVerification(false);
                $response = $this->gateway->purchase(array(
                    'amount' => $amount,
                    'currency' => 'USD',
                    'returnUrl' => route('site.omniPay.succes'),
                    'cancelUrl' => route('site.omniPay.error'),
                ))->send();
           
                if ($response->isRedirect()) {
                    dd($response);
                    $response->redirect(); // this will automatically forward the customer
                } else {
                    // not successful
                    return $response->getMessage();
                    dd($response->getMessage());
                }
            } catch(Exception $e) {
                dd( $e->getMessage());
                return $e->getMessage();
            }
        }
    }
  
    public function payment_success(Request $request)
    {
        // Once the transaction has been approved, we need to complete it.
        if ($request->input('paymentId') && $request->input('PayerID'))
        {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'             => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();
          
            if ($response->isSuccessful())
            {
                // The customer has successfully paid.
                $arr_body = $response->getData();
          
                // Insert transaction data into the database
                $isPaymentExist = Payment::where('payment_id', $arr_body['id'])->first();
          
                if(!$isPaymentExist)
                {
                    $payment = new Payment;
                    $payment->payment_id = $arr_body['id'];
                    $payment->payer_id = $arr_body['payer']['payer_info']['payer_id'];
                    $payment->payer_email = $arr_body['payer']['payer_info']['email'];
                    $payment->amount = $arr_body['transactions'][0]['amount']['total'];
                    $payment->currency = env('PAYPAL_CURRENCY');
                    $payment->payment_status = $arr_body['state'];
                    $payment->save();
                }
          
                return "Payment is successful. Your transaction id is: ". $arr_body['id'];
            } else {
                return $response->getMessage();
            }
        } else {
            return 'Transaction is declined';
        }
    }
  
    public function payment_error()
    {
        return 'User is canceled the payment.';
    }
}

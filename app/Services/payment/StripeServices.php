<?php

namespace App\Services\Payment;

use App\Models\User;
use App\Services\Payment\Contract\PaymentInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\StripeClient;

class StripeServices implements PaymentInterface
{
    public $stipe ;

    public function __construct()
    {
        $this->stripe = new StripeClient(env('STRIPE_SECRET',''));
    }
    
    public  function  getInvoiceLink($total){
        $invoicelink  = $this->charge($total);
        return $invoicelink;
    }

    public  function  pay($products,$success_url,$error_url){

        $checkout = $this->checkout($products,$success_url,$error_url);
        
        return $checkout->button('Buy'); 
    }
    
    public function handleErrors($request)
    {

    }

    public function handlePaymenRequirements( $user)
    {
        // set user as astipe customer
        $stripe_cusotmer = $user->createOrGetStripeCustomer ();

        // create payment method
            
        $payment_method = $this->stripe->paymentMethods->create([
            'type' => 'card',
            'card' => [
              'number' => '4242424242424242',
              'exp_month' => 6,
              'exp_year' => 2022,
              'cvc' => '314',
            ],
        ]);

        //attach payment method to the user
        $default_payment_method = $this->stripe->paymentMethods->attach(
            $payment_method->id,
            ['customer' => $stripe_cusotmer->id]
        );

        // set as default payment method !!!!!!!!
        $this->stripe->customers->update(
            $stripe_cusotmer->id,
            ['default_source' => $default_payment_method->id ]
          );

        dd($user->defaultPaymentMethod()); // need to be tested
        
    }
    

      /***********************************/
    // return invoice pf paid , return 
    public function charge($total)
    {

        ## using laravel cashier
        $user = User::find(Auth::id());

        // if user is not acustomer or has no payment methods attached
        if( ! $user->defaultPaymentMethod()){
            $this->handlePaymenRequirements( $user);
        }
        // dd($user->defaultPaymentMethod());
        

        try {
            $payment =  $user->invoiceFor('Total Payment', $total*100 ); // returns stripe-invoce with status :paid

            // dd( $payment->hosted_invoice_url);
            return $payment->hosted_invoice_url;

        } catch (Exception $e) {

            throw $e ; 
        }


    }


    public function checkout($products,$success_url,$error_url)
    {

        // find or create products to stripe
        // get array of product_prices and quantities [product_price_id => quantity]

        

        
        $user = User::find(Auth::id());

        

        $checkout = $user->checkout(
            [
                ['price_1J6DyPIVdWaeh4NoUZeiByjX' => 12],
                'price_1J6Xg3IVdWaeh4NokmGho38P'
            ],
            [
            'success_url' => $success_url,
            'cancel_url' => $error_url,
            ]
        );

       
        return  $checkout;

    }

    /***********************************/


    

   

}

<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\User;
use App\Services\Fatoorah\FatoorahServices;
use App\Services\Payment\contract\PaymentInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    protected $payment;

    protected $invoiceId,  $paymentLink;


    public function __construct(PaymentInterface $payment)
    {
        // set middleware
        $this->middleware('auth:web');
       
        //Bring Fatoora services
        $this->payment = $payment;

    } // end of constructor

    // return the invoice link page
    public function invoiceLink()
    {
        $cart = session()->get('cart');

        // if no products in cart return back
        if (!isset($cart)) {
            return redirect()->back()->with('error', 'There is no product yet');
        }

        $data = $this->payment->getInvoiceLink( 'Lnk',session()->get('total_price'),Auth::user()->name);

        $invoiceId   = $data->InvoiceId;
        $paymentLink = $data->InvoiceURL;

        return view('site.payment.invoice-link', compact('invoiceId', 'paymentLink'));
    } // end of  check out


    // return checkout page
    public function checkout()
    {

        $cart = session()->get('cart');

        if (!isset($cart)) {
            return redirect()->back()->with('error', 'there is no product yet');
        }

        $paymentMethods = $this->payment->getPaymentMethod(session()->get('total_price'),'KWD');

        // call init payment 
        return view('site.payment.checkout', compact('paymentMethods'));
    } // end of  check out


    public function pay(Request $request)
    {
        
        $request->validate([
            'PaymentMethodId' => 'required',
        ]);

        $data = $this->payment->getPaymentLink(
            $request->PaymentMethodId, session()->get('total_price') ,
            route('site.payment.returnback.success'),
            route('site.payment.returnback.error')
        );

        //You can save payment data in database as per your needs
        $this->invoiceId   = $data->InvoiceId;
        $this->paymentLink = $data->PaymentURL;

        session()->put('invoiceId', $this->invoiceId);
        session()->put('paymentLink', $this->paymentLink);

        $user = User::findOrFail(Auth::id());
        $user->orders()->create([
            'isPaid' => false,
            'invoiceId' => $this->invoiceId,
            'paymentLink' => $this->paymentLink,
        ]);

        return view('site.payment.invoice-link', ['invoiceId' =>  $this->invoiceId, 'paymentLink' =>  $this->paymentLink]);
    }// end of pay

    


    public function returnbackSuccess(Request $request)
    {
        $Data = $this->payment->getPaymentCallBack($request);

        if($Data->InvoiceStatus != "Paid"){
            return;
        }

        // save order to db
        $user = User::findOrFail(Auth::id());
        $user->orders()->where('invoiceId',  session('invoiceId'))->update([
            'isPaid' => true,
        ]);


        // clear cart
        session()->forget('cart');
        CartController::delete();

        return view('site.payment.returnback-success')->with('success', 'payment succeeded');
    }// end of return back success


    public function returnBackError(Request $request)
    {
       $error="";

        $Data = $this->payment->getPaymentCallBack($request);

        if ( $Data->InvoiceStatus  == "Pending" ){

            foreach($Data->InvoiceTransactions as $transaction){
                if($transaction->PaymentId == $request->paymentId ){
                    $error = $transaction->Error;
                    break;
                }
            }
            
        }

        // save order to db
        $user = User::findOrFail(Auth::id());

        $user->orders()->where('invoiceId',  session('invoiceId') )->update([
            'isPaid' => false,
        ]);

        return redirect()->route('site.cart')->with('error', $error);
    }// end of returnbackError

}

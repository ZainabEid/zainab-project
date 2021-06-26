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
       
        //Bring payment service
        $this->payment = new  $payment;

    } // end of constructor

    // return the invoice link page
    public function invoiceLink()
    {
        $cart = session()->get('cart');

        // if no products in cart return back
        if (!isset($cart)) {
            return redirect()->back()->with('error', 'There is no product yet');
        }

        $InvoiceURL = $this->payment->getInvoiceLink( session()->get('total_price'));

        return view('site.payment.invoice-link', compact('InvoiceURL'));
    } // end of  check out


    public function pay()
    {
        $products = session('cart');

        $this->paymentLink = $this->payment->pay($products ,route('site.payment.returnback.success'),route('site.payment.returnback.error'));

        // save payment link in db
        $user = User::findOrFail(Auth::id());
        $order = $user->orders()->create([
            'isPaid' => false,
        ]);

        session()->put('order_id', $order->id );

        return view('site.payment.pay', ['paymentLink' =>  $this->paymentLink]);
    }// end of pay

    


    public function returnbackSuccess(Request $request)
    {
        // save order to db
        $user = User::findOrFail(Auth::id());
        $user->orders()->where('order_id',  session('order_id'))->update([
            'isPaid' => true,
        ]);


        // clear cart
        session()->forget('cart');
        CartController::delete();

        return view('site.payment.returnback-success')->with('success', 'payment succeeded');
    }// end of return back success


    public function returnBackError(Request $request)
    {
    

        // save order to db
        $user = User::findOrFail(Auth::id());

        $user->orders()->where('order_id',  session('order_id') )->update([ // need to use order_id instead of invoice id
            'isPaid' => false,
        ]);

        $error = $this->payment->handleErrors($request);

        return redirect()->route('site.cart')->with('error', 'payment faild pleas try again');
    }// end of returnbackError

}

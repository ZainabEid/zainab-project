<?php

namespace App\Services\Payment\contract;

use Illuminate\Http\Request;

Interface PaymentInterface
{

    public  function  getInvoiceLink($NotificationOption,$InvoiceValue,$CustomerName);
    public  function getPaymentMethod($InvoiceAmount,$CurrencyIso);
    public  function  getPaymentLink($PaymentMethodId, $InvoiceValue, $CallBackUrl, $ErrorUrl);
    public  function getPaymentCallBack(Request $request);

   
}
<?php

namespace App\Services\Payment\Contract;

use Illuminate\Http\Request;

Interface PaymentInterface
{

    public  function  getInvoiceLink($total);
    public  function  pay($products,$success_url,$error_url);
    public  function handleErrors($request);

   
}
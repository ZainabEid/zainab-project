<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable =[
        'gateway_payment_id' ,
         'user_id' ,
          'amount' ,
            'currency' ,
            'payment_status',
             'invoiceId',
              'transaction_id',
               'track_id',
                'shipping_id'
    ];

     ########### start relations #########
     public function user()
     {
         return $this->belongsTo(User::class);
     }// end user

} // end of payment model

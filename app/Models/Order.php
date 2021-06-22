<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'ispaid', 'invoiceId', 'paymentLink' 
    ];

    
    ########### start relations #########
    public function user()
    {
        return $this->belongsTo(User::class);
    }// end user


}// end of class

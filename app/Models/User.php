<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use Billable;

    protected $fillable = [
        'name','email','password','photo',
    ];

    
    protected $hidden = [
        'password', 'remember_token',
    ];

  
    protected $casts = [
        'email_verified_at' => 'datetime', 'user_phones'
        
    ];

    ############ Get Attributes #############
    public function getUserPhonesAttribute()
    {
        return $this->phones->pluck('phone'); 
    }


   ########### start relations #########

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }// end phones 
   
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }// end products 

    public function orders()
    {
        return $this->hasMany(Order::class);
    }// end of orders

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }// end of payments

}// end of user model

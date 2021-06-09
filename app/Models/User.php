<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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

}// end of user model

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $fillable =[
        'phone' , 'user_id'
    ]; 


    ########### start relations #########
    public function user()
    {
        return $this->belongsTo(User::class);
    }// end of user 



}// end of phones model

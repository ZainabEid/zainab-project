<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'ar_name' , 'en_name' , 'photo',
    ];

    protected $appends =[
        'name'
    ];

    public function getNameAttribute()
    {
        if (App::islocale('ar')) {
            return $this->ar_name;
        }
        return $this->en_name;
    }// end get name attribute

   
    ####### Relations ##########
    public function products()
    {
        return $this->hasMany(Product::class);
    }



}

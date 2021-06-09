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
        'name', 'photo_path'
    ];

    public function getNameAttribute()
    {
        if (App::islocale('ar')) {
            return $this->ar_name;
        }
        return $this->en_name;
    }// end get name attribute

    public function getPhotoPathAttribute()
    {
        return Storage::disk('local')->get('uploads/' . $this->photo);

    }// end of get photo path attribute



}

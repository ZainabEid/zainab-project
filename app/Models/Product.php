<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;

class Product extends Model
{
    use HasFactory;

    protected $fillable =[
        'name_ar', 'name_en','description_en','description_ar','price', 'photo'
        ];

        protected $casts = [
            'name', 'description', 
        ];

        public function getNameAttribute()
        {
            return Lang::locale() == 'ar' ? $this->name_ar : $this->name_en;
        }

        public function getDescriptionAttribute()
        {
            return Lang::locale() == 'ar' ? $this->description_ar : $this->description_en;
        }


}

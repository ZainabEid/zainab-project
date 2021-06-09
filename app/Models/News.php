<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';

    protected $fillable = [
        'title_ar', 'title_en', 'description', 'photo', 'admin_id'
    ];

    ############## start Relatoins ##############
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    } // end of admin 


}// end of news Model

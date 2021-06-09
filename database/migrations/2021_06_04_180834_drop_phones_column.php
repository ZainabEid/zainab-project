<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropPhonesColumn extends Migration
{
    
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phones');
        });
    }

  
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}

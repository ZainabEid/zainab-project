<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
   
    public function run()
    {
        $admin = Admin::create([
            'name' => 'Admin Name',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
        ]);
            
        $admin->assignRole('super_admin');

    }// end of run
}// end of admin table seeder class

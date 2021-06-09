<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            1 => [
                'en_name' => 'cat1',
                'ar_name' => 'تصنيف 1',
                'photo' => 'cat1.jpeg', 
                
            ],
            1 => [
                'en_name' => 'cat2',
                'ar_name' => 'تصنيف 2',
                'photo' => 'cat2.jpeg', 
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

    }
}

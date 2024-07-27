<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create([
            'name' => 'Category 1',
            'description' => 'This is Category 1',
            'status' => 'active',
        ]);

        Category::create([
            'name' => 'Category 2',
            'description' => 'This is Category 2',
            'status' => 'active',
        ]);

        Category::create([
            'name' => 'Category 3',
            'description' => 'This is Category 3',
            'status' => 'active',
        ]);
    }
}
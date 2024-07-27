<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $categoryExample1 = Category::where('name', 'Test category 1')->first();
        $categoryExample2 = Category::where('name', 'Test category 2')->first();
        $categoryExample3 = Category::where('name', 'Test category 3')->first();

        Product::create([
            'name' => 'First product category 1',
            'description' => 'This is product 1',
            'price' => 699.99,
            'category_id' => $categoryExample1->id,
            'status' => 'active',
        ]);

        Product::create([
            'name' => 'Second product category 1',
            'description' => 'This is product 2',
            'price' => 199.99,
            'category_id' => $categoryExample1->id,
            'status' => 'active',
        ]);

        Product::create([
            'name' => 'Product category 2',
            'description' => 'This is product 3',
            'price' => 129.99,
            'category_id' => $categoryExample2->id,
            'status' => 'active',
        ]);

        Product::create([
            'name' => 'Product category 3',
            'description' => 'This is product 4',
            'price' => 19.99,
            'category_id' => $categoryExample3->id,
            'status' => 'active',
        ]);

        Product::create([
            'name' => 'Product category 2',
            'description' => 'This is product 5',
            'price' => 49.99,
            'category_id' => $categoryExample3->id,
            'status' => 'active',
        ]);
    }
}
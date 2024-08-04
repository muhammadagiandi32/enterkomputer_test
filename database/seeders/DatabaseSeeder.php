<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $categories = [
            ['name' => 'Jeruk', 'type' => 'drink'],
            ['name' => 'Teh', 'type' => 'drink'],
            ['name' => 'Kopi', 'type' => 'drink'],
            ['name' => 'Mie', 'type' => 'food'],
            ['name' => 'Nasi Goreng', 'type' => 'food'],
            ['name' => 'Promo', 'type' => 'promo'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $products = [
            ['category_id' => 1, 'name' => 'Jeruk', 'variant' => 'DINGIN', 'price' => 12000],
            ['category_id' => 1, 'name' => 'Jeruk', 'variant' => 'PANAS', 'price' => 10000],
            ['category_id' => 2, 'name' => 'Teh', 'variant' => 'MANIS', 'price' => 8000],
            ['category_id' => 2, 'name' => 'Teh', 'variant' => 'TAWAR', 'price' => 5000],
            ['category_id' => 3, 'name' => 'Kopi', 'variant' => 'DINGIN', 'price' => 8000],
            ['category_id' => 3, 'name' => 'Kopi', 'variant' => 'PANAS', 'price' => 6000],
            ['category_id' => 4, 'name' => 'Mie', 'variant' => 'GORENG', 'price' => 15000],
            ['category_id' => 4, 'name' => 'Mie', 'variant' => 'KUAH', 'price' => 15000],
            ['category_id' => 5, 'name' => 'Nasi Goreng', 'variant' => null, 'price' => 15000],
            ['category_id' => 6, 'name' => 'Nasi Goreng + Jeruk Dingin', 'variant' => null, 'price' => 23000],
        ];
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

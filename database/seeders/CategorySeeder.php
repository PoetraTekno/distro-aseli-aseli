<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Seed product categories for Distro Aseli Aseli.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Kaos (T-Shirt)',
                'slug' => 'kaos-t-shirt',
            ],
            [
                'name' => 'Hoodie & Jaket',
                'slug' => 'hoodie-jaket',
            ],
            [
                'name' => 'Aksesoris & Topi',
                'slug' => 'aksesoris-topi',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                ['name' => $category['name']]
            );
        }
    }
}

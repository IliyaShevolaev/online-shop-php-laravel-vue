<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Product::factory()
            ->count(1)
            ->create()
            ->each(function ($product) {
                $genreIds = collect(range(1, 3))->random(rand(1, 3))->toArray();

                $product->genres()->sync($genreIds);
            });
    }
}

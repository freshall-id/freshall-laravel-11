<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use App\Models\Voucher;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed the User table
        User::factory()->count(5)->create();
        User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@freshall.id',
            'role' => 'ADMIN',
        ]);

        // Seed the ProductCategory table
        ProductCategory::factory()->count(5)->create();

        // Seed the Product table
        Product::factory()->count(50)->create();

        // Seed the Voucher table
        Voucher::factory()->count(5)->create();
    }
}
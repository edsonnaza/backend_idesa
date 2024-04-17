<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;


use App\Models\User;
use App\Models\Debt;
use App\Models\Product;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
 

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'IDESA SA',
            'email' => 'idesa@gmail.com',
            'password' => Hash::make('password'),
        ]);

        // Llama al DebtSeeder
        $this->call([DebtSeeder::class]);
        $this->call([ProductSeeder::class]);


    }
}

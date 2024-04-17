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
            'email' => 'admin@idesa.com.py',
            'password' => Hash::make('pass123'),
        ]);

        // Llama al DebtSeeder
        $this->call([DebtSeeder::class]);
        $this->call([ProductSeeder::class]);


    }
}

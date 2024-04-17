<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Debt;

class DebtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Debts
        $debts = [
            ['id' => 1, 'lote' => '00145', 'precio' => 150000, 'clientID' => 123456, 'vencimiento' => '2022-09-01'],
            ['id' => 2, 'lote' => '00146', 'precio' => 110000, 'clientID' => 135486, 'vencimiento' => null],
            ['id' => 3, 'lote' => '00147', 'precio' => 160000, 'clientID' => 135486, 'vencimiento' => null],
            ['id' => 4, 'lote' => '00148', 'precio' => 130000, 'clientID' => 123456, 'vencimiento' => '2022-10-01'],
            ['id' => 5, 'lote' => '00148', 'precio' => 145000, 'clientID' => 123456, 'vencimiento' => null],
            ['id' => 6, 'lote' => '00148', 'precio' => 190000, 'clientID' => 123456, 'vencimiento' => '2022-12-01'],
            ['id' => 7, 'lote' => '00148', 'precio' => 190000, 'clientID' => 123456, 'vencimiento' => '2023-01-01'],
            ['id' => 8, 'lote' => '00148', 'precio' => 190000, 'clientID' => 123456, 'vencimiento' => '2023-02-01'],
        ];

        foreach ($debts as $debt) {
            Debt::create($debt);
        }
    }
}

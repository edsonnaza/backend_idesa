<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Proveedor;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Categorias
        Categoria::create(['nombre' => 'Electrónicos']);
        Categoria::create(['nombre' => 'Ropa']);
        Categoria::create(['nombre' => 'Hogar']);

        // Seed Proveedores
        Proveedor::create(['nombre' => 'Tecnologías SA', 'direccion' => 'Ambay c/ Yrupe', 'telefono' => '+595983456789']);
        Proveedor::create(['nombre' => 'Electro Paraná', 'direccion' => 'La Paloma c/ Los Lapachos ', 'telefono' => '+595985738055']);

        // Seed Productos
        Producto::create(['nombre' => 'Smartphone', 'descripcion' => 'Teléfono inteligente', 'precio' => 500.00, 'categoria_id' => 1, 'proveedor_id' => 1]);
        Producto::create(['nombre' => 'Camiseta', 'descripcion' => 'Camiseta de algodón', 'precio' => 20.00, 'categoria_id' => 2, 'proveedor_id' => 2]);
        Producto::create(['nombre' => 'Mesa de Centro', 'descripcion' => 'Mesa para sala de estar', 'precio' => 150.00, 'categoria_id' => 3, 'proveedor_id' => 1]);
 
    }
}

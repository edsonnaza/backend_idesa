<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono'
       
    ];

     /**
     * Obtiene los productos con sus proveedor(s).
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}

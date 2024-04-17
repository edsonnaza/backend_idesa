<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $fillable = [
        'nombre',
       
    ];

    public $timestamps = false; // Deshabilita los timestamps

    public function products()
    {
        return $this->hasMany(Producto::class);
    }
}

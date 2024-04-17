<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\DesafioUno;
 
 

class DesafioUnoController extends Controller
{
    public function index($id)
    {
        // Llama al método getClientDebt con el ID del cliente
        DesafioUno::getClientDebt($id);
    }
}

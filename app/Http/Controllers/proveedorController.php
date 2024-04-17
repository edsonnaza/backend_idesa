<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Proveedor;

class proveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::all();

        if ($proveedores->isEmpty()) {
            $data = [
                'message' => 'No se encontraron datos en proveedores',
                'status' => 200
            ];
            return response()->json($data, 404);
        }

        $data = [
            'proveedores' => $proveedores,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'direccion' => 'required|max:255',
            'telefono' => 'required|max:20', // Supongo que el teléfono es un campo de texto, ajusta según necesidad
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $proveedor = Proveedor::create([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
        ]);

        if (!$proveedor) {
            $data = [
                'message' => 'Error al crear el proveedor',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'proveedor' => $proveedor,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function show($id)
    {
        $proveedor = Proveedor::find($id);

        if (!$proveedor) {
            $data = [
                'message' => 'Proveedor no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'proveedor' => $proveedor,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $proveedor = Proveedor::find($id);

        if (!$proveedor) {
            $data = [
                'message' => 'Proveedor no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        
        $proveedor->delete();

        $data = [
            'message' => 'Proveedor eliminada',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $proveedor = Proveedor::find($id);

        if (!$proveedor) {
            $data = [
                'message' => 'Proveedor no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $proveedor->name = $request->name;

        $proveedor->save();

        $data = [
            'message' => 'Proveedor actualizado',
            'proveedor' => $proveedor,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}


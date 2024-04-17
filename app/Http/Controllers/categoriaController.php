<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Categoria;

class categoriaController extends Controller
{
    public function index()
    {
        $categories = Categoria::all();

        if ($categories->isEmpty()) {
            $data = [
                'message' => 'No se encontraron datos en categorías',
                'status' => 200
            ];
            return response()->json($data, 404);
        }

        $data = [
            'categories' => $categories,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
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

        $category = Categoria::create([
            'name' => $request->name,
        ]);

        if (!$category) {
            $data = [
                'message' => 'Error al crear la categoría',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'category' => $category,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function show($id)
    {
        $category = Categoria::find($id);

        if (!$category) {
            $data = [
                'message' => 'Categoría no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'category' => $category,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $category = Categoria::find($id);

        if (!$category) {
            $data = [
                'message' => 'Categoría no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        
        $category->delete();

        $data = [
            'message' => 'Categoría eliminada',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $category = Categoria::find($id);

        if (!$category) {
            $data = [
                'message' => 'Categoría no encontrada',
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

        $category->name = $request->name;

        $category->save();

        $data = [
            'message' => 'Categoría actualizada',
            'category' => $category,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Producto;
use App\Http\Resources\ProductoResource;
 

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('proveedor', 'categoria')->get();

        if ($productos->isEmpty()) {
            $data = [
                'message' => 'No se encontraron datos en productos',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
    
        // Formatear los productos utilizando el recurso ProductoResource
        $productosFormatted = ProductoResource::collection($productos);
    
        $data = [
            'productos' => $productosFormatted,
            'status' => 200
        ];
    
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'categoria_id' => 'required|exists:categorias,id',
            'proveedor_id' => 'required|exists:proveedores,id',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $emptyFields = [];
            
            // Iterar sobre los errores y encontrar los campos vacíos
            foreach ($errors->messages() as $field => $error) {
                if (empty($error)) {
                    $emptyFields[] = $field;
                }
            }
            
            // Verificar si hay campos vacíos
            if (!empty($emptyFields)) {
                // Construir el mensaje de error incluyendo los campos vacíos
                $message = 'Los siguientes campos están vacíos: ' . implode(', ', $emptyFields);
            } else {
                // Si no hay campos vacíos, mostrar un mensaje genérico
                $message = 'Error en la validación de los datos. Por favor, complete todos los campos requeridos.';
            }
            
            $data = [
                'message' => $message,
                'status' => 400
            ];
            
            return response()->json($data, 400);
        }
        
        

        $producto = Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'categoria_id' => $request->categoria_id,
            'proveedor_id' => $request->proveedor_id,
        ]);

        if (!$producto) {
            $data = [
                'message' => 'Error al crear el producto',
                'status' => 500
            ];
            return response()->json($data, 500);
        }
        
         // Formatear los productos utilizando el recurso ProductoResource
         $productoFormatted = new ProductoResource($producto);
    
        $data = [
            'producto' => $productoFormatted,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function show($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            $data = [
                'message' => 'Producto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        

        $data = [
            'producto' => $producto,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            $data = [
                'message' => 'Producto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        
        $producto->delete();
        
        $data = [
            'message' => 'Producto eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            $data = [
                'message' => 'Producto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'categoria_id' => 'required|exists:categorias,id',
            'proveedor_id' => 'required|exists:proveedores,id',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->categoria_id = $request->categoria_id;
        $producto->proveedor_id = $request->proveedor_id;

        $producto->save();
        
        $productoFormatted = new ProductoResource($producto);
        $data = [
            'message' => 'Producto actualizado',
            'producto' => $productoFormatted,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function updatePartial(Request $request, $id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            $data = [
                'message' => 'Producto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'max:255',
            'precio' => 'numeric',
            'categoria_id' => 'exists:categorias,id',
            'proveedor_id' => 'exists:proveedores,id',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('nombre')) {
            $producto->nombre = $request->nombre;
        }

        if ($request->has('descripcion')) {
            $producto->descripcion = $request->descripcion;
        }

        if ($request->has('precio')) {
            $producto->precio = $request->precio;
        }

        if ($request->has('categoria_id')) {
            $producto->categoria_id = $request->categoria_id;
        }

        if ($request->has('proveedor_id')) {
            $producto->proveedor_id = $request->proveedor_id;
        }

        $producto->save();
        $productoFormatted = new ProductoResource($producto);
        $data = [
            'message' => 'Producto actualizado',
            'producto' => $productoFormatted,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}


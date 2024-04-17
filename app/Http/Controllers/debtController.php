<?php

namespace App\Http\Controllers;

 
use App\Models\Debt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class debtController extends Controller
{
    public function index()
    {
        $debts = Debt::all();

        if ($debts->isEmpty()) {
            $data = [
                'message' => 'No se encontraron datos en debts',
                'status' => 200
            ];
            return response()->json($data, 404);
        }

        $data = [
            'debts' => $debts,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {

        // 'lote',
        // 'precio',
        // 'clientID',
        // 'vencimiento'

        // $table->string('lote');
        // $table->integer('precio');
        // $table->integer('clientID');
        // $table->date('vencimiento')->nullable();

        $validator = Validator::make($request->all(), [
            'lote' => 'required|max:255',
            'precio' => 'required|numeric',
            'clientID' => 'required|integer',
            'vencimiento' => 'required|date'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $debt = Debt::create([
            'lote' => $request->lote,
            'precio' => $request->precio,
            'clientID' => $request->clientID,
            'vencimiento' => $request->vencimiento
        ]);

        if (!$debt) {
            $data = [
                'message' => 'Error al crear el estudiante',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'debt' => $debt,
            'status' => 201
        ];

        return response()->json($data, 201);

    }

    public function show($id)
    {
        $debt = Debt::find($id);

        if (!$debt) {
            $data = [
                'message' => 'Registro no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'debt' => $debt,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $debt = Debt::find($id);

        if (!$debt) {
            $data = [
                'message' => 'Registro no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        
        $debt->delete();

        $data = [
            'message' => 'Registro eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $debt = Debt::find($id);

        if (!$debt) {
            $data = [
                'message' => 'Registro no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'lote' => 'required|max:255',
            'precio' => 'required|numeric',
            'clientID' => 'required|integer',
            'vencimiento' => 'required|date'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $debt->lote = $request->lote;
        $debt->precio = $request->precio;
        $debt->clientID = $request->clientID;
        $debt->vencimiento = $request->vencimiento;

        $debt->save();

        $data = [
            'message' => 'Registro actualizado',
            'debt' => $debt,
            'status' => 200
        ];

        return response()->json($data, 200);

    }

    public function updatePartial(Request $request, $id)
    {
        $debt = Debt::find($id);

        if (!$debt) {
            $data = [
                'message' => 'Registro no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'lote' => 'max:255',
            'precio' => 'precio|unique:debt',
            'clientID' => 'digits:10',
            'vencimiento' => 'in:English,Spanish,French'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('lote')) {
            $debt->lote = $request->lote;
        }

        if ($request->has('precio')) {
            $debt->precio = $request->precio;
        }

        if ($request->has('clientID')) {
            $debt->clientID = $request->clientID;
        }

        if ($request->has('vencimiento')) {
            $debt->vencimiento = $request->vencimiento;
        }

        $debt->save();

        $data = [
            'message' => 'Registro actualizado',
            'debt' => $debt,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}

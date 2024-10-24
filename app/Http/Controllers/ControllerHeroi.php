<?php

namespace App\Http\Controllers;

use App\Models\Heroi;
use App\Responses\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ControllerHeroi extends Controller
{
    public function criar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:200',
            'poder' => 'required|numeric',
            'universo' => 'required|string|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $heroi = Heroi::create($request->all());
        return JsonResponse::success('Heroi cadastrado com sucesso', $heroi);
        
    }


    public function deletar($id)
    {
        $heroi = Heroi::findOrFail($id);
        $heroi->delete();
        
        return JsonResponse::success('Heroi deletado com sucesso', $heroi);
        
    }

    public function editar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:200',
            'poder' => 'required|numeric',
            'universo' => 'required|string|max:100'
            . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $heroi = Heroi::findOrFail($id);
        $heroi->update($request->all());

        return JsonResponse::success('Heroi alterado com sucesso', $heroi);
    }

    public function buscarPorId($id)
    {
        $heroi = Heroi::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Heroi encontrado',
            'data' => $heroi
        ], 200);
    }


    public function listarTodos()
    {
        $heroi = Heroi::all();
        return response()->json([
            'status' => true,
            'message' => 'Heroi listados',
            'data' => $heroi
        ], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Vilao;
use App\Responses\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ControllerVilao extends Controller
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

        $vilao = Vilao::create($request->all());
        return JsonResponse::success('Vilão cadastrado com sucesso', $vilao);
        
    }


    public function deletar($id)
    {
        $vilao = Vilao::findOrFail($id);
        $vilao->delete();
        
        return JsonResponse::success('Vilão deletado com sucesso', $vilao);
        
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

        $vilao = Vilao::findOrFail($id);
        $vilao->update($request->all());

        return JsonResponse::success('Vilão alterado com sucesso', $vilao);
    }

    public function buscarPorId($id)
    {
        $vilao = Vilao::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Vilão encontrado',
            'data' => $vilao
        ], 200);
    }


    public function listarTodos()
    {
        $vilao = Vilao::all();
        return response()->json([
            'status' => true,
            'message' => 'Vilões listados',
            'data' => $vilao
        ], 200);
    }
}

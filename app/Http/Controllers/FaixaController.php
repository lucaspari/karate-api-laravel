<?php

namespace App\Http\Controllers;

use App\Models\Faixa;
use App\Service\FaixaService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FaixaController extends Controller
{
    private FaixaService $faixaService;
    public function __construct(FaixaService $faixaService)
    {
        $this->faixaService = $faixaService;
    }
    public function index()
    {
        $nome = request()->query("urlPath");
        if(isset($nome)) return $this->faixaService->getFaixaByNome($nome);
        return $this->faixaService->getAllFaixas();
    }
    public function store(Request $request)
    {

        try {
            $this->faixaService->validate_faixa($request);
            $faixa = new Faixa([
                'nome' => $request->nome,
                'urlPath' => $request->urlPath
            ]);
            $faixa->save();
            return response()->json(['message' => 'Faixa criada com sucesso!', 'data' =>
            ["nome" => $faixa->nome, "urlPath" => $faixa->urlPath]], 201);
        } catch (ValidationException $e) {
            return response()->json($e->errors(), 422);
        }
    }
    public function show(string $id)
    {
        $faixa = Faixa::find($id);
        return $faixa ? response()->json($faixa, 200) :
            response()->json(['message' => 'Faixa não encontrada!'], 404);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Faixa::find($id)) return response()->json(['message' => 'Faixa não encontrada!'], 404);

        try {
            $this->faixaService->validate_faixa($request);
            $faixa = Faixa::find($id);
            $faixa->nome = $request->nome;
            $faixa->urlPath = $request->urlPath;
            $faixa->save();
            return response()->json(['message' => 'Faixa atualizada com sucesso!', 'data' =>
            ["nome" => $faixa->nome, "urlPath" => $faixa->urlPath]], 200);
        } catch (ValidationException $e) {
            return response()->json($e->errors(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $faixa = Faixa::find($id);
        if (!$faixa) return response()->json(['message' => 'Faixa não encontrada!'], 404);
        $faixa->delete();
        return response()->json(['message' => 'Faixa deletada com sucesso!', 'data' =>
        ["nome" => $faixa->nome, "urlPath" => $faixa->urlPath]]
        , 200);
    }
}

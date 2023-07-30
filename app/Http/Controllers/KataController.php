<?php

namespace App\Http\Controllers;

use App\Models\Kata;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KataController extends Controller
{
    public function index()
    {
        return Kata::all();
    }
    public function findKataByFaixaId($faixaId)
    {
        $kata = Kata::where('faixa_id', $faixaId)->first();
        if($kata){
            return response()->json($kata, 200);
        }
        return response()->json(['message' => 'Kata não encontrada!'], 404);
        //
    }
}

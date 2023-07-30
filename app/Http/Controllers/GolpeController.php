<?php

namespace App\Http\Controllers;
use App\Models\Golpe;
class GolpeController extends Controller
{
    public function index()
    {
        return response()->json(Golpe::all(),200);
    }
    public function findGolpesByFaixa( $faixaId){
        $golpes = Golpe::query()->where('faixa_id',$faixaId)->get();
        return response()->json($golpes,200);
    }
}

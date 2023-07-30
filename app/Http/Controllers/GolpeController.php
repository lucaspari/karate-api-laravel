<?php

namespace App\Http\Controllers;
use App\Models\Golpe;
use App\Service\FaixaService;
use App\Service\GolpeService;

class GolpeController extends Controller
{
    private $golpeService;
    public function __construct(GolpeService $golpeService){
        $this->golpeService = $golpeService;
    }
    public function index()
    {
        $url = request()->query('urlPath');
        if($url) return $this->golpeService->findByUrlPath($url);
        return response()->json(Golpe::all(),200);
    }

}

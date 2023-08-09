<?php

namespace App\Http\Controllers;

use App\Models\Golpe;
use App\Service\GolpeService;
use Exception;
use Illuminate\http\Request;
use Illuminate\Http\JsonResponse;

class GolpeController extends Controller
{
    private GolpeService $golpeService;

    public function __construct(GolpeService $golpeService)
    {
        $this->golpeService = $golpeService;
    }

    public function index(): JsonResponse
    {
        $url = request()->query('urlPath');
        $faixaId = request()->query('faixaId');
        if ($url) $golpes = $this->golpeService->findByUrlPath($url);
        else if ($faixaId) $golpes = $this->golpeService->findByFaixaId($faixaId);
        else $golpes = Golpe::all();
        return response()->json($golpes, 200);
    }

    public function random(): JsonResponse
    {
        $qtd = request()->query('qtd');
        $distinct = request()->query('distinct');
        if (isset($qtd)) $golpe = $this->golpeService->getRandomGolpe($distinct, (int)$qtd);
        else $golpe = $this->golpeService->getRandomGolpe();
        return response()->json($golpe, 200);
    }

    public function saveGolpes($faixaId, Request $request): JsonResponse
    {

        $golpes = $request->json();
        if ($this->golpeService->check_if_is_golpe($golpes)->fails()) {
            return response()->json($this->golpeService->check_if_is_golpe($golpes)->errors(), 400);
        }
        try {

            $this->golpeService->saveGolpesByFaixaId($faixaId, $golpes->all());
            return response()->json();
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }

    }

}


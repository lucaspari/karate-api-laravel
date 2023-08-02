<?php

namespace App\Http\Controllers;

use App\Exceptions\GolpeNotFoundException;
use App\Models\Golpe;
use App\Service\GolpeService;
use Illuminate\Http\JsonResponse;

class GolpeController extends Controller
{
    private $golpeService;
    public function __construct(GolpeService $golpeService)
    {
        $this->golpeService = $golpeService;
    }

    /**
     * @throws GolpeNotFoundException
     */
    public function index() : JsonResponse
    {
        $url = request()->query('urlPath');
        $faixaId = request()->query('faixaId');
        if ($url) $golpes =  $this->golpeService->findByUrlPath($url);
        else if ($faixaId) $golpes =  $this->golpeService->findByFaixaId($faixaId);
        else $golpes = Golpe::all();
        if (!$golpes) {
            throw new GolpeNotFoundException();
        }

        return response()->json($golpes, 200);
    }

    /**
     * @throws GolpeNotFoundException
     */
    public function random(): JsonResponse
    {
        $qtd = request()->query('qtd');
        $distinct = request()->query('distinct');
        if(isset($qtd)) $golpe = $this->golpeService->getRandomGolpe( $distinct,(int)$qtd);
        else $golpe = $this->golpeService->getRandomGolpe();
        if (!$golpe) {
            throw new GolpeNotFoundException();
        }
        return response()->json($golpe, 200);
    }
}

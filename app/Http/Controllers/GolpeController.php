<?php

namespace App\Http\Controllers;

use App\Exceptions\GolpeNotFoundException;
use App\Models\Golpe;
use App\Service\GolpeService;

class GolpeController extends Controller
{
    private $golpeService;
    public function __construct(GolpeService $golpeService)
    {
        $this->golpeService = $golpeService;
    }
    public function index()
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
}

<?php

namespace App\Http\Controllers;
use App\Service\KataService;

class KataController extends Controller
{
    protected $kataService;
    public function __construct(KataService $kataService)
    {
        $this->kataService = $kataService;
    }
    public function index()
    {
        $faixaId = request()->get('faixaId');
        if($faixaId != null) return $this->kataService->findKataById($faixaId);
        return $this->kataService->findAllKatas();
    }
}

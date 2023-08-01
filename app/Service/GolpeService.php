<?php

namespace App\Service;

use App\Models\Golpe;

class GolpeService
{
    public function findByUrlPath(string $url)
    {
        return Golpe::query()->where("urlPath", $url)->first();
    }
    public function findByFaixaId(string $faixaId)
    {
        return Golpe::query()->where("faixa_id", $faixaId)->get();
    }
    public function getRandomGolpe()
    {
        return Golpe::query()->inRandomOrder()->first();
    }
}

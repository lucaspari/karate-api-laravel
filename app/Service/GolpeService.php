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
    public function getRandomGolpe($distinct = "",$qtd = 1)
    {
        if ($qtd === 1) {
            return Golpe::query()->inRandomOrder()->limit(1)->first();
        } else {
            return Golpe::query()->where('urlPath', 'not like', '%' . $distinct . '%')
                ->limit(2)->inRandomOrder()
                ->get();
        }
    }
}

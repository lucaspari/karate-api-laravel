<?php

namespace App\Service;

use App\Models\Golpe;
use Illuminate\http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function getRandomGolpe($distinct = "", $qtd = 1)
    {
        if ($qtd === 1) {
            return Golpe::query()->inRandomOrder()->limit(1)->first();
        } else {
            return Golpe::query()->where('urlPath', 'not like', '%' . $distinct . '%')
                ->limit(2)->inRandomOrder()
                ->get();
        }
    }

    public function saveGolpesByFaixaId(string $id, object $golpes): void
    {
        foreach ($golpes as $golpe) {
            $golpe['faixa_id'] = $id;
            Golpe::query()->create($golpe);
        }
    }

    public function check_if_is_golpe($golpes): \Illuminate\Validation\Validator
    {
        return Validator::make($golpes->all(), [
            '*.nome' => 'required|string',
            '*.urlPath' => 'required|string',
            '*.tempo' => 'required|string',
            '*.descricao' => 'required|string',
            '*.url' => 'required|string',
            '*.detalhes' => 'required|string',
        ], [
            '*.nome.required' => 'O nome é obrigatório',
            '*.urlPath.required' => 'A urlPath é obrigatória',
            '*.tempo.required' => 'O tempo é obrigatório',
            '*.descricao.required' => 'A descrição é obrigatória',
            '*.url.required' => 'A url é obrigatória',
            '*.detalhes.required' => 'Os detalhes são obrigatórios',
        ]);
    }
}

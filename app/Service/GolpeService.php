<?php

namespace App\Service;

use App\Models\Golpe;
use Illuminate\http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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

    public function saveGolpesByFaixaId(string $id, array $golpes): void
    {
        $golpesToInsert = array_map(function ($golpe) use ($id) {
            return [
                "id" => substr(Str::uuid()->toString(), 0, 32),
                "nome" => $golpe['nome'],
                "urlPath" => $golpe['urlPath'],
                "tempo" => $golpe['tempo'],
                "descricao" => $golpe['descricao'],
                "url" => $golpe['url'],
                "detalhes" => $golpe['detalhes'],
                "faixa_id" => $id
            ];
        }, $golpes);
        Golpe::query()->insert($golpesToInsert);
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

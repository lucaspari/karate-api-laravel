<?php
namespace App\Service;
use App\Models\Golpe;
class GolpeService{
    public function findByUrlPath(string $url){
             $golpe = Golpe::query()->where("urlPath",$url)->first();
             return $golpe;
    }
    public function findByFaixaId(string $faixaId){
             $golpes = Golpe::query()->where("faixa_id",$faixaId)->get();
             return $golpes;
    }
}

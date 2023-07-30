<?php
namespace App\Service;

use App\Exceptions\GolpeNotFoundException;
use App\Models\Golpe;
use Exception;
use Illuminate\Support\Facades\Log;
class GolpeService{
    public function findByUrlPath(string $url){
        try{
             $golpe = Golpe::query()->where("urlPath",$url)->firstOrFail();
             return $golpe;
        }
        catch(Exception $e){
            Log::error($e->getMessage());
            throw new GolpeNotFoundException($url);
        }
    }
}

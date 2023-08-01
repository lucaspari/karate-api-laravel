<?php
namespace App\Service;
use App\Models\Faixa;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;


class FaixaService{


    function validate_faixa(Request $request){
        $request->validate([
            'nome' => 'required',
            "urlPath" => "required"
        ]);
    }
    public function getAllFaixas() : Collection{
        return Faixa::all();
    }
    public function getFaixaByNome(string $urlPath) : Collection{
        return Faixa::query()->where('urlPath', 'like', '%'.$urlPath.'%')->get();
    }
}
?>

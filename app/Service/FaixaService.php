<?php
namespace App\Service;
use Illuminate\Http\Request;
class FaixaService{
    
    function validate_faixa(Request $request){
        $request->validate([
            'nome' => 'required',
            "urlPath" => "required"
        ]);
    }
}
?>
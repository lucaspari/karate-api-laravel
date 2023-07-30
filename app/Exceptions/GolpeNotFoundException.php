<?php
namespace App\Exceptions;
use Exception;
use Illuminate\Http\Response;

class GolpeNotFoundException extends Exception{
    public function render(){
        return response()->json(["message"=>"golpe was not found"],
        Response::HTTP_NOT_FOUND);
    }
}
?>

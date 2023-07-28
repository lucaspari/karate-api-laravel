<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faixa extends Model
{
    use HasFactory;
    protected $table = "faixas";
    protected $fillable = [
        'id',
        'nome',
        'urlPath',
        'update_at',
        'created_at'
    ];
    protected $casts =[
        'id' =>'string',
    ];

  

    
}

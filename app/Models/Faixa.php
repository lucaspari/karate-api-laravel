<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faixa extends Model
{
    public $incrementing = false;
    use HasFactory;
    use HasUuids;
    protected $table = "faixas";
    protected $fillable = [
        'id',
        'nome',
        'urlPath',
        'updated_at',
        'created_at'
    ];

  

    
}

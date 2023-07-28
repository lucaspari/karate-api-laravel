<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kata extends Model
{
    use HasUuids, HasFactory;
    protected $fillable = [
        "id",
        "nome",
        "faixa_id",
        "url",
        "descricao",
        "created_at",
        "updated_at"
    ];
    public function faixa() : HasOne{
        return $this->hasOne(Faixa::class, "id", "faixa_id");
    }  
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Golpe extends Model
{
    use HasFactory,HasUuids;
    protected $table = "golpes";
    protected $fillable = [
        "id",
        "nome",
        "urlPath",
        "tempo",
        "descricao",
        "url",
        "detalhes",
        "faixa_id",
        "created_at",
        "updated_at"
    ];

    public function faixa() : HasOne{
        return $this->hasOne(Faixa::class, "id", "faixa_id");
    }
}

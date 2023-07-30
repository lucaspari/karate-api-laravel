<?php

namespace Tests\Feature;

use App\Models\Faixa;
use App\Models\Golpe;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Tests\TestCase;

class GolpeControllerTest extends TestCase
{
    use DatabaseTransactions;
    public function setup() : void{
        parent::setUp();
        Golpe::query()->delete();
    }
    public function test_return_all_golpes()
    {
        Golpe::factory()->count(3)->create();
        $response = $this->getJson("/api/golpes");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount(3);
    }
    public function test_return_golpes_by_faixaId(){
        $faixa = Faixa::factory()->createOne();
        Golpe::factory()->count(3)->create(["faixa_id" => $faixa->id]);
        $response = $this->getJson("/api/golpes?faixaId={$faixa->id}");
        $response->assertJsonCount(3);
        $response->assertStatus(200);
    }
    public function test_return_golpes_by_urlPath(){
        $golpe = Golpe::factory()->createOne();
        $response = $this->getJson("/api/golpes?urlPath={$golpe->urlPath}");
        $response->assertJsonFragment([
            "id" => $golpe->id,
            "nome" => $golpe->nome,
            "urlPath" => $golpe->urlPath,
            "descricao" => $golpe->descricao,
            "detalhes" => $golpe->detalhes,
            "url" => $golpe->url,
            "faixa_id" => $golpe->faixa_id,
            "tempo" => $golpe->tempo,
            "created_at" => $golpe->created_at,
            "updated_at" => $golpe->updated_at,

        ]);
        $response->assertStatus(200);
    }
    public function test_throw_golpeNotFoundException(){
        $response = $this->getJson("/api/golpes?urlPath=nao-existe");
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }


}

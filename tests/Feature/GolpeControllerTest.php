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

    public function setup(): void
    {
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

    public function test_return_golpes_by_faixaId()
    {
        $faixa = Faixa::factory()->createOne();
        Golpe::factory()->count(3)->create(["faixa_id" => $faixa->id]);
        $response = $this->getJson("/api/golpes?faixaId={$faixa->id}");
        $response->assertJsonCount(3);
        $response->assertStatus(200);
    }

    public function test_return_golpes_by_urlPath()
    {
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

    public function test_return_random_golpe()
    {
        Golpe::factory()->count(3)->create();
        $response = $this->getJson("/api/golpes/random");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'id',
            'nome',
            'urlPath',
            'tempo',
            'descricao',
            'url',
            'detalhes',
            'faixa_id',
            'created_at',
            'updated_at',
        ]);
    }

    public function test_return_random_golpe_with_qtd_and_distinct()
    {
        Golpe::factory()->count(2)->create();
        $response = $this->getJson("/api/golpes/random?qtd=2&distinct=true");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount(2);
    }

    public function test_saves_golpes_in_db()
    {
        $response = $this->getJson("/api/golpes/");
    }


}

<?php

namespace Tests\Feature;

use App\Models\Faixa;
use App\Models\Kata;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class KataControllerTest extends TestCase
{
    use DatabaseTransactions;
    public function setUp(): void
    {
        parent::setUp(); // @BeforeEach
        Kata::query()->delete();
    }
    public function test_can_get_all_katas()
    {
        Kata::factory()->count(3)->create();
        $response = $this->getJson('/api/katas');
        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(3);
    }
    public function test_find_kata_by_faixa_id(){
        $faixa = Faixa::factory()->createOne();
        $kata = Kata::factory()->createOne(['faixa_id' => $faixa->id]);
        $response = $this->getJson("/api/katas?faixaId={$faixa->id}");
        $response->assertStatus(RESPONSE::HTTP_OK);
        $response->assertJsonFragment([
            "id" => $kata->id,
            "nome" => $kata->nome,
            "descricao" => $kata->descricao,
            "url" => $kata->url,
            "faixa_id" => $kata->faixa_id,
            "created_at" => $kata->created_at,
            "updated_at" => $kata->updated_at
        ]);
    }
    public function test_find_kata_by_faixa_id_not_found(){
        $response = $this->getJson('/api/katas/999');
        $response->assertNotFound();
        $response->assertStatus(RESPONSE::HTTP_NOT_FOUND);
    }
}

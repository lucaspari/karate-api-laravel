<?php

namespace Tests\Feature;

use App\Models\Faixa;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Http\Response;

class FaixaControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp() : void{
        parent::setUp(); // @BeforeEach
        Faixa::query()->delete();
    }
    public function test_can_get_all_faixas()
    {
        Faixa::factory()->count(3)->create();
        $response = $this->getJson('/api/faixas');
        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(3);
    }
    public function test_can_get_faixa_by_id()
    {
        // Create a Faixa record in the database
        $faixa = Faixa::factory()->createOne();
        // Make a GET request to the /api/faixas/{id} endpoint with the Faixa ID
        $response = $this->getJson('/api/faixas/' . $faixa->id);
        // Assert that the response status is 200 OK
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment([
            "id" => $faixa->id,
            "nome" => $faixa->nome,
            "urlPath" => $faixa->urlPath
        ]);

    }
    public function test_returns_404_for_invalid_faixa_id()
    {
        // Make a GET request to the /api/faixas/{id} endpoint with an invalid Faixa ID
        $response = $this->getJson('/api/faixas/999');

        // Assert that the response status is 404 Not Found
        $response->assertStatus(Response::HTTP_NOT_FOUND);

        // Assert that the response contains the expected error message
        $response->assertJsonFragment([
            'message' => 'Faixa não encontrada!',
        ]);
    }
}
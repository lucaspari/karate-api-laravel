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
        $faixa = Faixa::factory()->count(10)->create();
        dd(strval($faixa));
        // Make a GET request to the /api/faixas/{id} endpoint with the Faixa ID
        $response = $this->getJson('/api/faixas/' . $faixa->id);
      

        // Assert that the response status is 200 OK
        $response->assertStatus(Response::HTTP_OK);

    }
}

<?php

namespace Tests\Feature;

use App\Models\Faixa;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Http\Response;

class FaixaControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_can_get_all_faixas()
    {
        Faixa::query()->delete();
        Faixa::factory()->count(3)->create();
        $response = $this->getJson('/api/faixas');
        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(3);
    }
}

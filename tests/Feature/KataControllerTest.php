<?php

namespace Tests\Feature;

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
        $response = $this->getJson('/api/faixas');
        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(3);
    }
}

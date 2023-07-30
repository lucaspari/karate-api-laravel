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

}

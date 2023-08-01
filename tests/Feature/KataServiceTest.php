<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Faixa;
use App\Service\KataService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Kata;
class KataServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function setup(): void
    {
        parent::setUp();
        Kata::query()->delete();
    }

    public function testFindAllKatas()
    {
        $kataService = new KataService();
        Kata::factory()->count(3)->create();
        $result = $kataService->findAllKatas();
        $this->assertCount(3, $result);
    }

    public function testFindKataById()
    {
        $kataService = new KataService();
        $faixa = Faixa::factory()->createOne();
        Kata::factory()->createOne(["faixa_id" => $faixa->id]);
        $result = $kataService->findKataById($faixa->id);
        $this->assertCount(1, $result);
    }
}


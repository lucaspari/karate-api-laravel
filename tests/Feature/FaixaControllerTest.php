<?php

namespace Tests\Feature;

use App\Models\Faixa;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Http\Response;

class FaixaControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
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

    public function test_can_create_faixa_with_valid_data()
    {
        // Make a POST request to the /api/faixas endpoint with valid data
        $response = $this->postJson('/api/faixas/create', [
            'nome' => 'Faixa 1',
            'urlPath' => '/path/to/faixa1.mp3',
        ]);

        // Assert that the response status is 201 Created
        $response->assertStatus(Response::HTTP_CREATED);

        // Assert that the response contains the expected data
        $response->assertJson([
            'message' => 'Faixa criada com sucesso!',
            'data' => [
                'nome' => 'Faixa 1',
                'urlPath' => '/path/to/faixa1.mp3',
            ],
        ]);
    }

    public function test_cannot_create_faixa_with_invalid_data()
    {
        // Make a POST request to the /api/faixas endpoint with invalid data
        $response = $this->postJson('/api/faixas/create', [
            'nome' => '',
            'urlPath' => '',
        ]);
        // Assert that the response status is 422 Unprocessable Entity
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $errors = json_decode($response->getContent(), true);
        // Convert the array to a JSON string with the expected error messages
        $expected = json_encode([
            'nome' => ['The nome field is required.'],
            'urlPath' => ['The url path field is required.'],
        ]);

        // Assert that the response content matches the expected error messages
        $this->assertEquals($expected, json_encode($errors));
    }
    public function test_can_update_faixa()
{
    // Create a new Faixa
    $faixa = Faixa::factory()->createOne();

    // Make a PUT request to the /api/faixas/{id} endpoint with valid data
    $response = $this->putJson("/api/faixas/{$faixa->id}", [
        'nome' => 'Nova Faixa',
        'urlPath' => '/path/to/nova_faixa.mp3',
    ]);

    // Assert that the response status is 200 OK
    $response->assertStatus(Response::HTTP_OK);

    // Assert that the response contains the expected message and data
    $response->assertJson([
        'message' => 'Faixa atualizada com sucesso!',
        'data' => [
            'nome' => 'Nova Faixa',
            'urlPath' => '/path/to/nova_faixa.mp3',
        ],
    ]);

    // Assert that the Faixa was updated in the database
    $this->assertDatabaseHas('faixas', [
        'id' => $faixa->id,
        'nome' => 'Nova Faixa',
        'urlPath' => '/path/to/nova_faixa.mp3',
    ]);
}
public function test_cannot_update_faixa_with_invalid_data()
{
    // Create a new Faixa
    $faixa = Faixa::factory()->createOne();

    // Make a PUT request to the /api/faixas/{id} endpoint with invalid data
    $response = $this->putJson("/api/faixas/{$faixa->id}", [
        'nome' => '',
        'urlPath' => '',
    ]);

    // Assert that the response status is 422 Unprocessable Entity
    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

    $errors = json_decode($response->getContent(), true);
    // Convert the array to a JSON string with the expected error messages
    $expected = json_encode([
        'nome' => ['The nome field is required.'],
        'urlPath' => ['The url path field is required.'],
    ]);

    // Assert that the response content matches the expected error messages
    $this->assertEquals($expected, json_encode($errors));
}
}

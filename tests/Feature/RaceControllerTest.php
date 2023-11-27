<?php

namespace Tests\Feature;

use App\Models\Race;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RaceControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testRequiredFieldsForSaverace(): void
    {
        $this->json('POST', 'api/race', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "success" => false,
                "message" => "Validation errors",
                "data" => [
                    "name" => ["Name is required"],
                    "date" => ["Date is required"],
                    "rules" => ["Rules is required"],
                ]
            ]);
    }

    public function testSuccessfulraceSave()
    {
        $raceData = [
            "name" => "Corrida",
            "rules" => "Regras",
            "date" => "01-12-2015 12:12",
        ];

        $this->json('POST', 'api/race', $raceData, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                "data" => [
                    'id',
                    'name',
                    'rules',
                    "date",
                    'created_at',
                    'updated_at',
                    'deleted_at',
                ],
            ]);
    }

    public function testSuccessfulraceList()
    {
        Race::factory()->create();

        $this->json('GET', 'api/race', ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "data" => [
                    "*" => [
                        'id',
                        'name',
                        'rules',
                        "date",
                        'created_at',
                        'updated_at',
                        'deleted_at',
                    ]
                ],
            ]);
    }

    public function testSuccessfulraceFind()
    {
        $race = Race::factory()->create();

        $this->json('GET', "api/race/$race->id", ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertExactJson([
                "data" => [
                    'id' => $race->id,
                    'name' => $race->name,
                    'rules' => $race->rules,
                    "date" => $race->date,
                    'created_at' => $race->created_at,
                    'updated_at' => $race->updated_at,
                    'deleted_at' => $race->deleted_at,
                ]
            ]);
    }

    public function testSuccessfulraceListAllCancelled()
    {
        $race = Race::factory()->create();
        $race->delete();

        $this->json('GET', "api/race/cancelled", ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "data" => [
                    "*" => [
                        'id',
                        'name',
                        'rules',
                        "date",
                        'created_at',
                        'updated_at',
                        'deleted_at',
                    ]
                ],
            ]);
    }

    public function testErrorraceNotFound()
    {
        $race = Race::factory()->create();
        $id = $race->id + 1;

        $this->json('GET', "api/race/$id", ['Accept' => 'application/json'])
            ->assertStatus(404);
    }

    public function testSuccessfulraceRemove()
    {
        $race = Race::factory()->create();

        $this->json('DELETE', "api/race/$race->id", ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertSee(1);
    }

    public function testErrorraceNotFoundToRemove()
    {
        $race = Race::factory()->create();
        $idNotFound = $race->id + 1;

        $this->json('DELETE', "api/race/$idNotFound", ['Accept' => 'application/json'])
            ->assertStatus(404);
    }
}

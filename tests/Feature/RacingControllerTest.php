<?php

namespace Tests\Feature;

use App\Models\Racings;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RacingControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testRequiredFieldsForSaveRacing(): void
    {
        $this->json('POST', 'api/racing', ['Accept' => 'application/json'])
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

    public function testSuccessfulRacingSave()
    {
        $racingData = [
            "name" => "Corrida",
            "rules" => "Regras",
            "date" => "01-12-2015 12:12",
        ];

        $this->json('POST', 'api/racing', $racingData, ['Accept' => 'application/json'])
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

    public function testSuccessfulRacingList()
    {
        Racings::factory()->create();

        $this->json('GET', 'api/racing', ['Accept' => 'application/json'])
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

    public function testSuccessfulRacingFind()
    {
        $racing = Racings::factory()->create();

        $this->json('GET', "api/racing/$racing->id", ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertExactJson([
                "data" => [
                    'id' => $racing->id,
                    'name' => $racing->name,
                    'rules' => $racing->rules,
                    "date" => $racing->date,
                    'created_at' => $racing->created_at,
                    'updated_at' => $racing->updated_at,
                    'deleted_at' => $racing->deleted_at,
                ]
            ]);
    }

    public function testSuccessfulRacingListAllCancelled()
    {
        $racing = Racings::factory()->create();
        $racing->delete();

        $this->json('GET', "api/racing/cancelled", ['Accept' => 'application/json'])
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

    public function testErrorRacingNotFound()
    {
        $racing = Racings::factory()->create();
        $id = $racing->id + 1;

        $this->json('GET', "api/racing/$id", ['Accept' => 'application/json'])
            ->assertStatus(404);
    }

    public function testSuccessfulRacingRemove()
    {
        $racing = Racings::factory()->create();

        $this->json('DELETE', "api/racing/$racing->id", ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertSee(1);
    }

    public function testErrorRacingNotFoundToRemove()
    {
        $racing = Racings::factory()->create();
        $idNotFound = $racing->id + 1;

        $this->json('DELETE', "api/racing/$idNotFound", ['Accept' => 'application/json'])
            ->assertStatus(404);
    }
}

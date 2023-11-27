<?php

namespace Tests\Unit;

use App\Repositories\RaceRepository;
use App\Services\RaceService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RaceServiceTest extends TestCase
{
    private $repository;

    public function setUp(): void
    {
        parent::setup();

        $this->repository = \Mockery::mock(RaceRepository::class);
    }

    public function test_find_one_race(): void
    {
        $race = [
            'id' => fake()->randomDigit(),
            'name' => fake()->name(),
            'rules' => fake()->text(),
            'date' => fake()->dateTimeThisMonth()->format('d-m-Y H:i'),
        ];

        $this->repository
            ->shouldReceive('findById')
            ->with($race['id'])
            ->andReturn($race);

        $service = new RaceService($this->repository);
        $result = $service->findById($race['id']);

        $this->assertEquals($race, $result);
    }

    public function test_find_all_race(): void
    {
        $return = [
            "data" => [
                [
                    'id' => fake()->randomDigit(),
                    'name' => fake()->sentence(),
                    'rules' => fake()->text(),
                    'date' => fake()->dateTimeThisMonth()->format('d-m-Y H:i'),
                    'updated_at' => date('H:i:s', rand(1, 54000)),
                    'created_at' => date('H:i:s', rand(1, 54000)),
                    'deleted_at' => NULL
                ],
                [
                    'id' => fake()->randomDigit(),
                    'name' => fake()->sentence(),
                    'rules' => fake()->text(),
                    'date' => fake()->dateTimeThisMonth()->format('d-m-Y H:i'),
                    'updated_at' => date('H:i:s', rand(1, 54000)),
                    'created_at' => date('H:i:s', rand(1, 54000)),
                    'deleted_at' => NULL
                ],
            ]
        ];

        $this->repository
            ->shouldReceive('findAll')
            ->andReturn($return);

        $service = new RaceService($this->repository);
        $result = $service->findAll();

        $this->assertEquals($return, $result);
    }

    public function test_find_all_race_cancelled(): void
    {
        $return = [
            "data" => [
                [
                    'id' => fake()->randomDigit(),
                    'name' => fake()->name(),
                    'rules' => fake()->text(),
                    'date' => fake()->dateTimeThisMonth()->format('d-m-Y H:i'),
                    'updated_at' => date('H:i:s', rand(1, 54000)),
                    'created_at' => date('H:i:s', rand(1, 54000)),
                    'deleted_at' => date('H:i:s', rand(1, 54000))
                ],
                [
                    'id' => fake()->randomDigit(),
                    'name' => fake()->name(),
                    'rules' => fake()->text(),
                    'date' => fake()->dateTimeThisMonth()->format('d-m-Y H:i'),
                    'updated_at' => date('H:i:s', rand(1, 54000)),
                    'created_at' => date('H:i:s', rand(1, 54000)),
                    'deleted_at' => date('H:i:s', rand(1, 54000))
                ],
            ]
        ];

        $this->repository
            ->shouldReceive('findAllDeleded')
            ->andReturn($return);

        $service = new RaceService($this->repository);
        $result = $service->findAllDeleded();

        $this->assertEquals($return, $result);
    }

    public function test_notfound_race(): void
    {
        $id = fake()->randomDigit();

        $this->repository
            ->shouldReceive('findById')
            ->with($id)
            ->andThrow(new NotFoundHttpException('NotFound'));

        $this->expectExceptionMessage('NotFound');

        $service = new RaceService($this->repository);
        $service->findById($id);
    }

    public function test_race_to_remove(): void
    {
        $race = [
            'id' => fake()->randomDigit(),
            'name' => fake()->name(),
            'rules' => fake()->text(),
            'date' => fake()->dateTimeThisMonth()->format('d-m-Y H:i'),
        ];

        $this->repository
            ->shouldReceive('delete')
            ->with($race['id'])
            ->andReturn(true);

        $service = new RaceService($this->repository);
        $result = $service->delete($race['id']);

        $this->assertTrue($result);
    }

    public function test_notfound_race_to_remove(): void
    {
        $id = fake()->randomDigit();

        $this->repository
            ->shouldReceive('delete')
            ->with($id)
            ->andThrow(new NotFoundHttpException('NotFound'));

        $this->expectExceptionMessage('NotFound');

        $service = new RaceService($this->repository);
        $service->delete($id);
    }
}

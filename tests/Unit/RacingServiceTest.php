<?php

namespace Tests\Unit;

use App\Repositories\RacingRepository;
use App\Services\RacingService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RacingServiceTest extends TestCase
{
    private $repository;

    public function setUp(): void
    {
        parent::setup();

        $this->repository = \Mockery::mock(RacingRepository::class);
    }

    public function test_find_one_racing(): void
    {
        $racing = [
            'id' => fake()->randomDigit(),
            'name' => fake()->name(),
            'rules' => fake()->text(),
            'date' => fake()->dateTimeThisMonth()->format('d-m-Y H:i'),
        ];

        $this->repository
            ->shouldReceive('findById')
            ->with($racing['id'])
            ->andReturn($racing);

        $service = new RacingService($this->repository);
        $result = $service->findById($racing['id']);

        $this->assertEquals($racing, $result);
    }

    public function test_find_all_racing(): void
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

        $service = new RacingService($this->repository);
        $result = $service->findAll();

        $this->assertEquals($return, $result);
    }

    public function test_find_all_racing_cancelled(): void
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

        $service = new RacingService($this->repository);
        $result = $service->findAllDeleded();

        $this->assertEquals($return, $result);
    }

    public function test_notfound_racing(): void
    {
        $id = fake()->randomDigit();

        $this->repository
            ->shouldReceive('findById')
            ->with($id)
            ->andThrow(new NotFoundHttpException('NotFound'));

        $this->expectExceptionMessage('NotFound');

        $service = new RacingService($this->repository);
        $service->findById($id);
    }

    public function test_racing_to_remove(): void
    {
        $racing = [
            'id' => fake()->randomDigit(),
            'name' => fake()->name(),
            'rules' => fake()->text(),
            'date' => fake()->dateTimeThisMonth()->format('d-m-Y H:i'),
        ];

        $this->repository
            ->shouldReceive('delete')
            ->with($racing['id'])
            ->andReturn(true);

        $service = new RacingService($this->repository);
        $result = $service->delete($racing['id']);

        $this->assertTrue($result);
    }

    public function test_notfound_racing_to_remove(): void
    {
        $id = fake()->randomDigit();

        $this->repository
            ->shouldReceive('delete')
            ->with($id)
            ->andThrow(new NotFoundHttpException('NotFound'));

        $this->expectExceptionMessage('NotFound');

        $service = new RacingService($this->repository);
        $service->delete($id);
    }
}

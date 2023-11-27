<?php

namespace App\Http\Controllers;

use App\Http\Requests\RacingSaveRequest;
use App\Http\Resources\Racing;
use App\Services\RacingService;

class RacingController extends Controller
{
    protected $service;

    public function __construct(RacingService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $racings = $this->service->findAll();

        return Racing::collection($racings);
    }

    public function find($id)
    {
        $racing = $this->service->findById($id);

        return new Racing($racing);
    }

    public function findDeleted()
    {
        $racings = $this->service->findAllDeleded();

        return Racing::collection($racings);
    }

    public function save(RacingSaveRequest $request)
    {
        $data = $request->validated();

        $racing = $this->service->save($data);

        return new Racing($racing);
    }

    public function delete($id)
    {
        $racing = $this->service->delete($id);

        return $racing;
    }
}

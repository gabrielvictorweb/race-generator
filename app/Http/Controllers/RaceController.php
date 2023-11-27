<?php

namespace App\Http\Controllers;

use App\Http\Requests\RaceSaveRequest;
use App\Http\Resources\Race;
use App\Services\RaceService;

class RaceController extends Controller
{
    protected $service;

    public function __construct(RaceService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $races = $this->service->findAll();

        return Race::collection($races);
    }

    public function find($id)
    {
        $race = $this->service->findById($id);

        return new Race($race);
    }

    public function findDeleted()
    {
        $races = $this->service->findAllDeleded();

        return Race::collection($races);
    }

    public function save(RaceSaveRequest $request)
    {
        $data = $request->validated();

        $race = $this->service->save($data);

        return new Race($race);
    }

    public function delete($id)
    {
        $race = $this->service->delete($id);

        return $race;
    }
}

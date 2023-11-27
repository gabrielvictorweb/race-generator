<?php

namespace App\Repositories;

use App\Repositories\Interfaces\RaceRepositoryInterface;
use App\Models\Race;

class RaceRepository implements RaceRepositoryInterface
{
    protected $entity;

    public function __construct(Race $entity)
    {
        $this->entity = $entity;
    }

    public function findAll()
    {
        return $this->entity::all();
    }

    public function findAllDeleded()
    {
        return $this->entity::onlyTrashed()->get();
    }

    public function findById(int $id)
    {
        return $this->entity->findOrFail($id);
    }

    public function save(array $data)
    {
        return $this->entity->create($data);
    }

    public function delete(int $id)
    {
        $races = $this->entity->findOrFail($id);
        return $races->delete();
    }
}

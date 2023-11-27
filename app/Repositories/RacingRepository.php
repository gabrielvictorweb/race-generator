<?php

namespace App\Repositories;

use App\Repositories\Interfaces\RacingRepositoryInterface;
use App\Models\Racings;

class RacingRepository implements RacingRepositoryInterface
{
    protected $entity;

    public function __construct(Racings $entity)
    {
        $this->entity = $entity;
    }

    /**
     * Get all racings
     * @return array
     */
    public function findAll()
    {
        return $this->entity::all();
    }

    /**
     * Get all racings
     * @return array
     */
    public function findAllDeleded()
    {
        return $this->entity::onlyTrashed()->get();
    }

    /**
     * Seleciona a racings por ID
     * @param int $id
     * @return object
     */
    public function findById(int $id)
    {
        return $this->entity->findOrFail($id);
    }

    /**
     * Cria uma nova racings
     * @param array $data
     * @return object
     */
    public function save(array $data)
    {
        return $this->entity->create($data);
    }

    /**
     * deleta uma racings
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        $racings = $this->entity->findOrFail($id);
        return $racings->delete();
    }
}

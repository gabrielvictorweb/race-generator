<?php

namespace App\Services;

use App\Repositories\Interfaces\RaceRepositoryInterface;

class RaceService
{
  protected $repository;

  public function __construct(RaceRepositoryInterface $repository)
  {
    $this->repository = $repository;
  }

  public function findAll()
  {
    return $this->repository->findAll();
  }

  public function findAllDeleded()
  {
    return $this->repository->findAllDeleded();
  }

  public function findById(int $id)
  {
    return $this->repository->findById($id);
  }

  public function save(array $data)
  {
    return $this->repository->save($data);
  }

  public function delete(int $id)
  {
    return $this->repository->delete($id);
  }
}

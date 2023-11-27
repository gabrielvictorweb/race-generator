<?php

namespace App\Services;

use App\Repositories\Interfaces\RacingRepositoryInterface;

class RacingService
{
  protected $repository;

  public function __construct(RacingRepositoryInterface $repository)
  {
    $this->repository = $repository;
  }

  /**
   * Selecione todas as corridas
   * @return array
   */
  public function findAll()
  {
    return $this->repository->findAll();
  }

  /**
   * Selecione todas as corridas
   * @return array
   */
  public function findAllDeleded()
  {
    return $this->repository->findAllDeleded();
  }

  /**
   * Seleciona uma corrida pelo ID
   * @param int $id
   * @return object
   */
  public function findById(int $id)
  {
    return $this->repository->findById($id);
  }

  /**
   * Seleciona uma corrida pelo ID
   * @param int $id
   * @return object
   */
  public function save(array $data)
  {
    return $this->repository->save($data);
  }

  /**
   * Deleta uma corrida
   * @param int $id
   * @return bool
   */
  public function delete(int $id)
  {
    return $this->repository->delete($id);
  }
}

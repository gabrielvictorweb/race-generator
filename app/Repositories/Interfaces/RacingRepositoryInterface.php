<?php

namespace App\Repositories\Interfaces;

interface RacingRepositoryInterface
{
    public function findAll();
    public function findAllDeleded();
    public function findById(int $id);
    public function save(array $data);
    public function delete(int $id);
}

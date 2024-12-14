<?php

namespace App\Domain\Repositories;

use App\Domain\DTO\PaginationDTO;
use App\Domain\Entities\Usuario;
use Illuminate\Database\Eloquent\Model;

interface CrudRepository
{
    public function search(array $filters): PaginationDTO;

    public function findBy(int $id): Model;

    public function create(Model $usuario): Model;

    public function update(int $id, Model $usuario): bool;

    public function delete(int $id): bool;
}

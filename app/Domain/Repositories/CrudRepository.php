<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Usuario;
use Illuminate\Database\Eloquent\Model;

interface CrudRepository
{
    public function search(): array;

    public function findBy(int $id): Model;

    public function create(Model $usuario): Model;

    public function update(int $id, Model $usuario): bool;

    public function delete(int $id): bool;
}

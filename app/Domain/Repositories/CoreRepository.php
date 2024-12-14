<?php

namespace App\Domain\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface CoreRepository
{
    public function search(array $filters): Collection;

    public function findBy(int $id): Model;

    public function create(Model $usuario): Model;

    public function update(int $id, Model $usuario): bool;

    public function delete(int $id): bool;

    public function totalItems(): int;
}

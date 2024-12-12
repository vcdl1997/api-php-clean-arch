<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Repositories\CrudRepository;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository implements CrudRepository
{
    protected Model $entity;

    public function __construct(Model $entity)
    {
        $this->entity = $entity;
    }

    public function findBy(int $id): Model {
        return $this->entity::findOrFail($id);
    }

    public function create(Model $entity): Model {
        return $this->entity::create($entity->toArray());
    }

    public function update(int $id, Model $entity): bool {
        return $this->findBy($id)->update($entity->toArray());
    }

    public function delete($id): bool {
        return $this->findBy($id)->delete();
    }
}

<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Repositories\CoreRepository;
use \Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

abstract class AbstractRepository implements CoreRepository
{
    protected Model $entity;
    protected Builder $builder;

    public function __construct(Model $entity)
    {
        $this->entity = $entity;
        $this->builder = DB::table($entity->getTable());
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

    public function totalItems(): int {
        $this->builder = $this->builder->limit(PHP_INT_MAX)->offset(0);
        return $this->builder->count();
    }

    protected function addEquals(string $column = null, mixed $value = null): self {
        if(!empty($column) && !empty($value)) {
            $this->builder = $this->builder->where($column, '=', $value);
        }

        return $this;
    }

    protected function addPagination(array $pagination = []): self {
        if($pagination['enablePagination']){
            $page = (int) data_get($pagination, 'page',0);
            $limit = (int) data_get($pagination, 'limit',10);
            $offset = empty($page) ? 0 : ($limit * $page);
            $this->builder = $this->builder->limit($limit)->offset($offset);
        }

        return $this;
    }
}

<?php

namespace App\Infrastructure\Repositories\Impl;

use App\Domain\Entities\Usuario;
use App\Domain\Repositories\UsuarioRepository;
use App\Infrastructure\Repositories\AbstractRepository;
use \Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

class UsuarioRepositoryImpl extends AbstractRepository implements UsuarioRepository
{
    public function __construct(Usuario $usuario) {
        parent::__construct($usuario);
    }

    public function search(array $filters): Collection {
        return $this->buildQuery( $filters)->get()->mapContentToArray();
    }

    private function buildQuery(array $filters): Builder {
        return $this->addProjection()->addFilters($filters)->addOrders($filters)->addPagination($filters)->builder;
    }

    private function addProjection(): self {
        $this->builder = $this->builder->select([
            Usuario::ID,
            Usuario::NOME,
            Usuario::IDADE
        ]);

        return $this;
    }

    private function addFilters(array $filters): self {
        $id = data_get($filters,Usuario::ID);
        $nome = data_get($filters,Usuario::NOME);
        $idade = data_get($filters,Usuario::IDADE);

        return $this
            ->addEquals(Usuario::ID, $id)
            ->addEquals(Usuario::NOME, $nome)
            ->addEquals(Usuario::IDADE, $idade)
        ;
    }
}

<?php

namespace App\Infrastructure\Repositories\Impl;

use App\Domain\DTO\PaginationDTO;
use App\Domain\Entities\Usuario;
use App\Domain\Repositories\UsuarioRepository;
use App\Infrastructure\Repositories\AbstractRepository;
use \Illuminate\Database\Query\Builder;

class UsuarioRepositoryImpl extends AbstractRepository implements UsuarioRepository
{
    public function __construct(Usuario $usuario) {
        parent::__construct($usuario);
    }

    public function search(array $filters): array {
        $users = $this->buildQuery( $filters)->get()->map(function ($usuario) {
            return (array) $usuario;
        });
        $totalItems = $this->totalItems();

        return PaginationDTO::build($users, $totalItems)->addMeta($filters)->addLinks('usuario.search')->toArray();
    }

    private function buildQuery(array $filters) : Builder {
        return $this->addProjection()->addFilters($filters)->addPagination($filters)->builder;
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
        $id = data_get($filters,key: Usuario::ID);
        $nome = data_get($filters,Usuario::NOME);
        $idade = data_get($filters,Usuario::IDADE);

        return $this
            ->addEquals(Usuario::ID, $id)
            ->addEquals(Usuario::NOME, $nome)
            ->addEquals(Usuario::IDADE, $idade)
        ;
    }
}

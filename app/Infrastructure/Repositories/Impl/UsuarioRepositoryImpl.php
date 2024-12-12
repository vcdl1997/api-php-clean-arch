<?php

namespace App\Infrastructure\Repositories\Impl;

use App\Domain\Entities\AbstractEntity;
use App\Domain\Entities\Usuario;
use App\Domain\Repositories\CrudRepository;
use App\Domain\Repositories\UsuarioRepository;
use App\Infrastructure\Repositories\AbstractRepository;

class UsuarioRepositoryImpl extends AbstractRepository implements UsuarioRepository
{
    public function __construct(Usuario $usuario)
    {
        parent::__construct($usuario);
    }

    public function search(): array {
        return collect(Usuario::orderBy(Usuario::DT_HR_CRIACAO)->get())->toArray();
    }
}

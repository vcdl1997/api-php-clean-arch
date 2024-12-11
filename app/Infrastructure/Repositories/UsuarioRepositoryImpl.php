<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Usuario;
use App\Domain\Repositories\UsuarioRepository;

class UsuarioRepositoryImpl implements UsuarioRepository
{
    public function search(): array {
        return collect(Usuario::orderBy(Usuario::DT_HR_CRIACAO)->get())->toArray();
    }

    public function findBy(int $id): Usuario {
        return Usuario::findOrFail($id);
    }

    public function create(Usuario $usuario): Usuario {
        return Usuario::create($usuario->toArray());
    }

    public function update(int $id, Usuario $usuario): bool {
        return $this->findBy($id)->update($usuario->toArray());
    }

    public function delete(int $id): bool {
        return $this->findBy($id)->delete();
    }
}

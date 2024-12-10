<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Usuario;

interface UsuarioRepository
{
    public function search(): array;

    public function findBy(int $id): Usuario;

    public function create(Usuario $usuario): Usuario;

    public function update(int $id, Usuario $usuario): bool;

    public function delete(int $id): bool;
}

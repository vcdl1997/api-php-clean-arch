<?php

namespace App\Application\Services;

use App\Domain\Entities\Usuario;
use App\Domain\Repositories\UsuarioRepository;
use App\Domain\VO\FiltroUsuarioVO;
use App\Domain\VO\UsuarioVO;
use App\Shared\Exceptions\BadRequestException;
use App\Shared\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Log;

class UsuarioService {

    private UsuarioRepository $usuarioRepository;

    public function __construct(UsuarioRepository $usuarioRepository){
        $this->usuarioRepository = $usuarioRepository;
    }

    public function search(FiltroUsuarioVO $filtroVO): array
    {
        return $this->usuarioRepository->search($filtroVO->all());
    }

    public function findBy(int $id): Usuario {
        try{
            return $this->usuarioRepository->findBy($id);
        }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            throw new NotFoundException("Usuário não encontrado");
        }
    }

    public function create(UsuarioVO $usuarioVO): Usuario {
        return $this->usuarioRepository->create( $usuarioVO->toEntity());
    }

    public function update(int $id, UsuarioVO $usuarioVO): Usuario {
        try{
            if(!$this->usuarioRepository->update( $id, $usuarioVO->toEntity())){
                throw new BadRequestException("Erro ao atualizar Usuário");
            }
            return $this->usuarioRepository->findBy($id);
        }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            throw new NotFoundException("Usuário não encontrado");
        }
    }

    public function delete(int $id): void {
        try{
            if(!$this->usuarioRepository->delete( $id)){
                throw new BadRequestException("Erro ao deletar Usuário");
            }
        }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            throw new NotFoundException("Usuário não encontrado");
        }
    }
}

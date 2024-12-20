<?php

namespace App\Application\Services;

use App\Domain\DTO\{PaginationDTO, UsuarioDTO};
use App\Domain\Entities\Usuario;
use App\Domain\Repositories\UsuarioRepository;
use App\Domain\VO\{FiltroUsuarioVO, UsuarioVO};
use App\Shared\Exceptions\{BadRequestException, NotFoundException};
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class UsuarioService {

    private UsuarioRepository $usuarioRepository;

    public function __construct(UsuarioRepository $usuarioRepository){
        $this->usuarioRepository = $usuarioRepository;
    }

    public function search(FiltroUsuarioVO $filtroVO, bool $pagination = true): PaginationDTO|Collection
    {
        $filters = $filtroVO->enablePagination($pagination);
        $data = $this->usuarioRepository->search($filters->all());

        if(!$pagination) return $data;

        return PaginationDTO::build($data, $this->usuarioRepository->totalItems())->addMeta($filters->all())->addLinks('usuario.search');
    }

    public function findBy(int $id): Usuario {
        try{
            return $this->usuarioRepository->findBy($id);
        }catch(ModelNotFoundException $e){
            throw new NotFoundException("Usuário não encontrado");
        }
    }

    public function create(UsuarioVO $usuarioVO): UsuarioDTO {
        return UsuarioDTO::build($this->usuarioRepository->create( $usuarioVO->toEntity()));
    }

    public function update(int $id, UsuarioVO $usuarioVO): UsuarioDTO {
        try{
            if(!$this->usuarioRepository->update( $id, $usuarioVO->toEntity())){
                throw new BadRequestException("Erro ao atualizar Usuário");
            }
            return UsuarioDTO::build($this->usuarioRepository->findBy($id));
        }catch(ModelNotFoundException $e){
            throw new NotFoundException("Usuário não encontrado");
        }
    }

    public function delete(int $id): void {
        try{
            if(!$this->usuarioRepository->delete( $id)){
                throw new BadRequestException("Erro ao deletar Usuário");
            }
        }catch(ModelNotFoundException $e){
            throw new NotFoundException("Usuário não encontrado");
        }
    }
}

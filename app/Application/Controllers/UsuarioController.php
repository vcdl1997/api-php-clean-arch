<?php

namespace App\Application\Controllers;

use App\Application\Contracts\UsuarioApi;
use App\Application\Services\UsuarioService;
use App\Domain\VO\FiltroUsuarioVO;
use App\Domain\VO\UsuarioVO;
use App\Shared\Enums\HttpStatusEnum;
use App\Shared\Utils\ResponseUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class UsuarioController extends Controller implements UsuarioApi
{
    private UsuarioService $usuarioService;

    public function __construct(UsuarioService $usuarioService){
        $this->usuarioService = $usuarioService;
    }

    public function search(FiltroUsuarioVO $filtroVO): JsonResponse {
        return Response::json($this->usuarioService->search($filtroVO), HttpStatusEnum::OK);
    }

    public function findBy(int $id): JsonResponse  {
        return Response::json($this->usuarioService->findBy($id), status: HttpStatusEnum::OK);
    }

    public function create(UsuarioVO $usuarioVO): JsonResponse  {
        return ResponseUtils::created($this->usuarioService->create($usuarioVO), "usuario.findBy");
    }

    public function update(int $id, UsuarioVO $usuarioVO): JsonResponse  {
        return Response::json($this->usuarioService->update($id, $usuarioVO), HttpStatusEnum::OK);
    }

    public function delete(int $id): JsonResponse  {
        return Response::json($this->usuarioService->delete($id), HttpStatusEnum::NO_CONTENT);
    }
}

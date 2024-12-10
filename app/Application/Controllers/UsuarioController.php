<?php

namespace App\Application\Controllers;

use App\Application\Contracts\UsuarioApi;
use App\Application\Services\UsuarioService;
use App\Domain\VO\UsuarioVO;
use App\Shared\Enums\HttpStatusEnum;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class UsuarioController extends Controller implements UsuarioApi
{
    private UsuarioService $usuarioService;

    public function __construct(UsuarioService $usuarioService){
        $this->usuarioService = $usuarioService;
    }

    public function search(): JsonResponse {
        return Response::json($this->usuarioService->search(), HttpStatusEnum::OK);
    }

    public function findBy(int $id): JsonResponse  {
        return Response::json($this->usuarioService->findBy($id), HttpStatusEnum::OK);
    }

    public function create(UsuarioVO $usuarioVO): JsonResponse  {
        return Response::json($this->usuarioService->create($usuarioVO), HttpStatusEnum::CREATED);
    }

    public function update(int $id, UsuarioVO $usuarioVO): JsonResponse  {
        return Response::json($this->usuarioService->update($id, $usuarioVO), HttpStatusEnum::ACCEPTED);
    }

    public function delete(int $id): JsonResponse  {
        return Response::json($this->usuarioService->delete($id), HttpStatusEnum::NO_CONTENT);
    }
}

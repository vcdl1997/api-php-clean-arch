<?php

namespace App\Application\Contracts;

use App\Domain\VO\UsuarioVO;
use Illuminate\Http\JsonResponse;

interface UsuarioApi extends BaseApi
{
    public function search(): JsonResponse;

    /**
     * @OA\Get(
     *   path="/api/usuarios/{id}",
     *   tags={"Usuários"},
     *   summary="Busca um usuário pelo ID.",
     *   security={ {"apiAuth": {} }},
     *   @OA\Parameter(
     *       description="ID do Usuário",
     *       in="path",
     *       name="id",
     *       required=true,
     *       @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(response=200, description="Usuário encontrado com sucesso."),
     *   @OA\Response(response=400, description="Erro ao processar requisição."),
     *   @OA\Response(response=404, description="Usuário não encontrado."),
     *   @OA\Response(response=500, description="Servidor não pode atender à solicitação.")
     * )
     */
    public function findBy(int $id): JsonResponse;

    public function create(UsuarioVO $usuarioVO): JsonResponse;

    public function update(int $id, UsuarioVO $usuarioVO): JsonResponse;

    public function delete(int $id): JsonResponse;
}

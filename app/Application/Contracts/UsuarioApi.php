<?php

namespace App\Application\Contracts;

use App\Domain\VO\UsuarioVO;
use Illuminate\Http\JsonResponse;

interface UsuarioApi extends BaseApi
{
    /**
     * @OA\Get(
     *   path="/usuarios",
     *   tags={"Usuários"},
     *   summary="Busca um ou mais usuários de acordo com os filtros informados.",
     *   security={ {"apiAuth": {} }},
     *   @OA\Response(
     *       response=200,
     *       description="Usuários encontrados com sucesso.",
     *       @OA\JsonContent(
     *           type="array",
     *           @OA\Items(
     *               type="object",
     *               @OA\Property(property="id", type="integer", description="ID do usuário"),
     *               @OA\Property(property="nome", type="string", description="Nome do usuário"),
     *               @OA\Property(property="idade", type="integer", description="Idade do usuário"),
     *               @OA\Property(property="created_at", type="string", format="date-time", description="Data de criação"),
     *               @OA\Property(property="updated_at", type="string", format="date-time", description="Data de última atualização")
     *           )
     *       )
     *   ),
     *   @OA\Response(
     *       response=422,
     *       description="Campos inválidos.",
     *       @OA\JsonContent(
     *           type="array",
     *           @OA\Items(
     *               type="object",
     *               @OA\Property(property="field", type="string", description="Campo"),
     *               @OA\Property(property="message", type="string", description="Mensagem")
     *           )
     *       )
     *   ),
     *   @OA\Response(
     *       response=500,
     *       description="Servidor não pode atender à solicitação.",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", description="Mensagem de erro"),
     *           @OA\Property(property="timestamp", type="string", format="date-time", description="Data da ocorrência do erro")
     *       )
     *   )
     * )
     */
    public function search(): JsonResponse;

    /**
     * @OA\Get(
     *   path="/usuarios/{id}",
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
     *   @OA\Response(
     *       response=200,
     *       description="Usuário encontrado com sucesso.",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="id", type="integer", description="ID do usuário"),
     *           @OA\Property(property="nome", type="string", description="Nome do usuário"),
     *           @OA\Property(property="idade", type="integer", description="Idade do usuário"),
     *           @OA\Property(property="created_at", type="string", format="date-time", description="Data de criação"),
     *           @OA\Property(property="updated_at", type="string", format="date-time", description="Data de última atualização")
     *       )
     *   ),
     *   @OA\Response(
     *       response=404,
     *       description="Usuário não encontrado.",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", description="Mensagem de erro"),
     *           @OA\Property(property="timestamp", type="string", format="date-time", description="Data da ocorrência do erro")
     *       )
     *   ),
     *   @OA\Response(
     *       response=500,
     *       description="Servidor não pode atender à solicitação.",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", description="Mensagem de erro"),
     *           @OA\Property(property="timestamp", type="string", format="date-time", description="Data da ocorrência do erro")
     *       )
     *   )
     * )
     */
    public function findBy(int $id): JsonResponse;

    /**
     * @OA\Post(
     *   path="/usuarios",
     *   tags={"Usuários"},
     *   summary="Cria um novo usuário.",
     *   security={ {"apiAuth": {} }},
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\JsonContent(
     *           type="object",
     *           required={"nome", "idade"},
     *           @OA\Property(property="nome", type="string", description="Nome do usuário"),
     *           @OA\Property(property="idade", type="integer", description="Idade do usuário")
     *       )
     *   ),
     *   @OA\Response(
     *       response=201,
     *       description="Usuário criado com sucesso.",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="id", type="integer", description="ID do usuário"),
     *           @OA\Property(property="nome", type="string", description="Nome do usuário"),
     *           @OA\Property(property="idade", type="integer", description="Idade do usuário"),
     *           @OA\Property(property="created_at", type="string", format="date-time", description="Data de criação"),
     *           @OA\Property(property="updated_at", type="string", format="date-time", description="Data de última atualização")
     *       ),
     *       @OA\Header(
     *           header="Location",
     *           description="URL do novo usuário",
     *           @OA\Schema(type="string", example="/usuarios/{id}")
     *       )
     *   ),
     *   @OA\Response(
     *       response=422,
     *       description="Campos inválidos.",
     *       @OA\JsonContent(
     *           type="array",
     *           @OA\Items(
     *               type="object",
     *               @OA\Property(property="field", type="string", description="Campo"),
     *               @OA\Property(property="message", type="string", description="Mensagem")
     *           )
     *       )
     *   ),
     *   @OA\Response(
     *       response=500,
     *       description="Servidor não pode atender à solicitação.",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", description="Mensagem de erro"),
     *           @OA\Property(property="timestamp", type="string", format="date-time", description="Data da ocorrência do erro")
     *       )
     *   )
     * )
     */
    public function create(UsuarioVO $usuarioVO): JsonResponse;

    /**
     * @OA\Put(
     *   path="/usuarios/{id}",
     *   tags={"Usuários"},
     *   summary="Atualiza um usuário existente.",
     *   security={ {"apiAuth": {} }},
     *   @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       description="ID do usuário a ser atualizado",
     *       @OA\Schema(type="integer")
     *   ),
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\JsonContent(
     *           type="object",
     *           required={"nome", "idade"},
     *           @OA\Property(property="nome", type="string", description="Nome do usuário"),
     *           @OA\Property(property="idade", type="integer", description="Idade do usuário")
     *       )
     *   ),
     *   @OA\Response(
     *       response=200,
     *       description="Usuário atualizado com sucesso.",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="id", type="integer", description="ID do usuário"),
     *           @OA\Property(property="nome", type="string", description="Nome do usuário"),
     *           @OA\Property(property="idade", type="integer", description="Idade do usuário"),
     *           @OA\Property(property="created_at", type="string", format="date-time", description="Data de criação"),
     *           @OA\Property(property="updated_at", type="string", format="date-time", description="Data de última atualização")
     *       )
     *   ),
     *   @OA\Response(
     *       response=404,
     *       description="Usuário não encontrado.",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", description="Mensagem de erro"),
     *           @OA\Property(property="timestamp", type="string", format="date-time", description="Data da ocorrência do erro")
     *       )
     *   ),
     *   @OA\Response(
     *       response=422,
     *       description="Campos inválidos.",
     *       @OA\JsonContent(
     *           type="array",
     *           @OA\Items(
     *               type="object",
     *               @OA\Property(property="field", type="string", description="Campo"),
     *               @OA\Property(property="message", type="string", description="Mensagem")
     *           )
     *       )
     *   ),
     *   @OA\Response(
     *       response=500,
     *       description="Servidor não pode atender à solicitação.",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", description="Mensagem de erro"),
     *           @OA\Property(property="timestamp", type="string", format="date-time", description="Data da ocorrência do erro")
     *       )
     *   )
     * )
     */
    public function update(int $id, UsuarioVO $usuarioVO): JsonResponse;

    /**
     * @OA\Delete(
     *   path="/usuarios/{id}",
     *   tags={"Usuários"},
     *   summary="Exclui um usuário existente.",
     *   security={ {"apiAuth": {} }},
     *   @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       description="ID do usuário a ser excluído",
     *       @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(
     *       response=204,
     *       description="Usuário excluído com sucesso. Não retorna conteúdo."
     *   ),
     *   @OA\Response(
     *       response=404,
     *       description="Usuário não encontrado.",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", description="Mensagem de erro"),
     *           @OA\Property(property="timestamp", type="string", format="date-time", description="Data da ocorrência do erro")
     *       )
     *   ),
     *   @OA\Response(
     *       response=500,
     *       description="Servidor não pode atender à solicitação.",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="message", type="string", description="Mensagem de erro"),
     *           @OA\Property(property="timestamp", type="string", format="date-time", description="Data da ocorrência do erro")
     *       )
     *   )
     * )
     */
    public function delete(int $id): JsonResponse;
}

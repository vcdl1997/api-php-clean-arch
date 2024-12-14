<?php

namespace App\Domain\DTO;

use App\Domain\Entities\Usuario;
use Illuminate\Support\Carbon;
use JsonSerializable;

class UsuarioDTO implements JsonSerializable
{
    private int $id;
    private string $nome;
    private int $idade;
    private string $dataCriacao;
    private string|null $dataAtualizacao;

    public function __construct(int $id, string $nome, int $idade, string $dataCriacao, string|null $dataAtualizacao){
        $this->id = $id;
        $this->nome = $nome;
        $this->idade = $idade;
        $this->dataCriacao = $dataCriacao;
        $this->dataAtualizacao = $dataAtualizacao;
    }

    public function jsonSerialize(): array {
        return [
            "id" => $this->id,
            "nome" => $this->nome,
            "idade" => $this->idade,
            "dataCriacao" => Carbon::parse($this->dataCriacao)->format('d/m/Y H:i:s'),
            "dataAtualizacao" =>  $this->dataAtualizacao ? Carbon::parse($this->dataAtualizacao)->format('d/m/Y H:i:s') : null
        ];
    }

    public static function build(Usuario $usuario): UsuarioDTO {
        return new UsuarioDTO(
            $usuario->{Usuario::ID},
            $usuario->{Usuario::NOME},
            $usuario->{Usuario::IDADE},
            $usuario->{Usuario::DT_HR_CRIACAO}->toDateTimeString(),
            $usuario->{Usuario::DT_HR_ATUALIZACAO} ? $usuario->{Usuario::DT_HR_ATUALIZACAO}->toDateTimeString() : null
        );
    }
}

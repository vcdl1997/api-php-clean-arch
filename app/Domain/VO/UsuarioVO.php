<?php

namespace App\Domain\VO;

use App\Domain\Entities\Usuario;
use Illuminate\Foundation\Http\FormRequest;

class UsuarioVO extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'idade' => ['required', 'integer', 'min:18'],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo “nome” é obrigatório',
            'nome.string' => 'O campo “nome” deve ser do tipo string',
            'nome.max' => 'O campo “nome” de possuir no máximo 255 caracteres',
            'idade.required' => 'O campo “idade” é obrigatória',
            'idade.integer' => 'O campo “idade” deve ser do tipo integer',
            'idade.min' => 'O valor mínimo permitido para o campo “idade” é 18'
        ];
    }

    public function toEntity(): Usuario
    {
        return new Usuario([
            'nome' => $this->input('nome'),
            'idade' => $this->input('idade')
        ]);
    }
}

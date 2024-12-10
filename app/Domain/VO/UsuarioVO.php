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
            'nome' => 'required|string|max:255',
            'idade' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome é obrigatório',
            'idade.required' => 'A idade é obrigatória',
            'nome.string' => 'O nome deve ser do tipo string',
            'idade.integer' => 'A idade deve ser do tipo integer',
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

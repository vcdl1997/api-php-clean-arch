<?php

namespace App\Domain\VO;

class FiltroUsuarioVO extends PaginationVO
{
    public function validationData()
    {
        return $this->query->all();
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $parentRules = parent::rules();

        $myRules = [
            'nome' => ['nullable', 'string', 'max:255'],
            'idade' => ['nullable', 'integer'],
        ];

        return array_merge($parentRules, $myRules);
    }

    public function messages(): array
    {
        $parentMessages = parent::messages();

        $myMessages = [
            'nome.string' => 'O campo “nome” deve ser do tipo string',
            'nome.max' => 'O campo “nome” deve possuir no máximo 255 caracteres',
            'idade.integer' => 'A idade deve ser do tipo integer',
        ];

        return array_merge($parentMessages, $myMessages);
    }
}

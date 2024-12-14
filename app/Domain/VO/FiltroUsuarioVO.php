<?php

namespace App\Domain\VO;

class FiltroUsuarioVO extends PaginationVO
{
    const SORT_COLUMNS = ['id','nome','idade'];
    const CONVERTED_SORT_COLUMNS = ['id','nome','idade'];

    public static function build(): PaginationVO {
        return new FiltroUsuarioVO();
    }

    public function nome(string $nome): PaginationVO {
        $this->merge(['nome' => $nome]);
        return $this;
    }

    public function idade(int $idade): PaginationVO {
        $this->merge(['idade' => $idade]);
        return $this;
    }
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
        $parentRules['order'][] = $this->checkOrder(self::SORT_COLUMNS);
        $myRules = [
            'nome' => ['nullable', 'string', 'max:255'],
            'idade' => ['nullable', 'integer']
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

    public function prepareForValidation(): void {
    }

    public function passedValidation(): void {
        $this->merge([
            'order' => $this->transformOrder($this->input('order')),
        ]);
    }

    public function transformOrder(string|null $order): string|null {
        $sortColumns = self::SORT_COLUMNS;
        $convertedSortColumns = self::CONVERTED_SORT_COLUMNS;

        return $order ? str_replace($sortColumns, $convertedSortColumns, $order) : null;
    }
}

<?php

namespace App\Domain\VO;

use Illuminate\Foundation\Http\FormRequest;

abstract class PaginationVO extends FormRequest
{
    const REGEX_COLUMN_SORTING = '/^([a-zA-Z_]+,(asc|desc))(,([a-zA-Z_]+,(asc|desc)))*$/';
    public function rules(): array
    {
        return [
            'order' => ['nullable', 'string', 'regex:' . self::REGEX_COLUMN_SORTING],
            'limit' => ['nullable', 'integer', 'max:1000'],
            'page' => ['nullable', 'integer', 'min:0']
        ];
    }

    public function messages(): array
    {
        return [
            'order.string' => 'O campo “order” deve ser do tipo string',
            'order.regex' => 'O campo “order” deve seguir conforme o exemplo: campo_abc,asc|desc...',
            'limit.integer' => 'O campo “limit” deve ser do tipo integer',
            'limit.max' => 'O campo “limit” só suporta até 1000 registros por página',
            'page.integer' => 'O campo “page” deve ser do tipo integer',
            'page.max' => 'O valor mínimo permitido para o campo “page” é 0'
        ];
    }
}

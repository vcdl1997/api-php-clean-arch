<?php

namespace App\Domain\VO;

use Illuminate\Foundation\Http\FormRequest;

abstract class PaginationVO extends FormRequest
{
    const REGEX_LAST_COMMA = '/,(?!.*,)/';
    const REGEX_COLUMN_SORTING = '/^([a-zA-Z_]+,(asc|desc))(,([a-zA-Z_]+,(asc|desc)))*$/';

    public function enablePagination(bool $enablePagination): self {
        $this->merge(['enablePagination' => $enablePagination]);
        return  $this;
    }

    public function page(int $page): self {
        $this->merge(['page' => $page]);
        return  $this;
    }

    public function limit(int $limit): self {
        $this->merge(['limit' => $limit]);
        return  $this;
    }

    public function order(string $order): self {
        if(preg_match(self::REGEX_COLUMN_SORTING, $order)){
            $this->merge(['order' => $order]);
        }
        return  $this;
    }

    public function rules(): array
    {
        return [
            'page' => ['nullable', 'integer', 'min:0'],
            'limit' => ['nullable', 'integer', 'max:1000'],
            'order' => ['nullable', 'string', 'regex:' . self::REGEX_COLUMN_SORTING],
        ];
    }

    public function messages(): array
    {
        return [
            'page.integer' => 'O campo “page” deve ser do tipo integer',
            'page.max' => 'O valor mínimo permitido para o campo “page” é 0',
            'limit.integer' => 'O campo “limit” deve ser do tipo integer',
            'limit.max' => 'O campo “limit” só suporta até 1000 registros por página',
            'order.string' => 'O campo “order” deve ser do tipo string',
            'order.regex' => 'O campo “order” deve seguir conforme o exemplo: campo_abc,asc|desc...',
        ];
    }

    public abstract function transformOrder(string|null $order): string|null;

    protected function checkOrder(array $validSortableColumns){
        return function ($attribute, $value, $fail) use ($validSortableColumns){
            $columnsToSort = explode(',', str_replace([',asc', ',desc'], [], $value));

            if (empty(array_intersect($columnsToSort, $validSortableColumns))) {
                $fail('O campo “order” só permite os seguintes valores: ' .  preg_replace(self::REGEX_LAST_COMMA, " e", implode(', ',  $validSortableColumns)));
            }
        };
    }
}

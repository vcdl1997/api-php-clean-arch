<?php

namespace App\Domain\Entities;

use App\Domain\Traits\CommonTableColumns;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use CommonTableColumns;

    const TABELA = 'usuario';
    const ID = 'id';
    const NOME = 'nome';
    const IDADE = 'idade';
    protected $table = self::TABELA;

    protected $fillable = [
        self::NOME,
        self::IDADE,
        self::DT_HR_CRIACAO,
        self::DT_HR_ATUALIZACAO,
        self::DT_HR_DELECAO,
    ];

    protected $dates = [
        self::DT_HR_CRIACAO,
        self::DT_HR_ATUALIZACAO,
        self::DT_HR_DELECAO,
    ];

    protected $primaryKey = self::ID;

    protected $casts = [
        self::DT_HR_CRIACAO => 'datetime',
        self::DT_HR_ATUALIZACAO => 'datetime',
        self::DT_HR_DELECAO => 'datetime',
    ];

    public function __construct(array $attributes = [])
    {
        if (!isset($attributes[self::DT_HR_CRIACAO])) {
            $attributes[self::DT_HR_CRIACAO] = now();
        }

        parent::__construct($attributes);
    }

}

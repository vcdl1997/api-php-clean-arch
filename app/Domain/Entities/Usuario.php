<?php

namespace App\Domain\Entities;

use App\Domain\Traits\CommonTableColumns;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use CommonTableColumns;

    const TABELA = 'usuario';
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

    public $timestamps = false;

    protected $casts = [
        self::DT_HR_CRIACAO => 'datetime',
        self::DT_HR_ATUALIZACAO => 'datetime',
        self::DT_HR_DELECAO => 'datetime',
    ];

    protected function serializeDate(\DateTimeInterface $date)
    {
        /** @var DateTimeInterface $date */
        return $date->setTimezone(config('app.timezone'))->format('Y-m-d H:i:s');
    }

    public function __construct(array $attributes = [])
    {
        if (!isset($attributes[self::DT_HR_CRIACAO])) {
            $attributes[self::DT_HR_CRIACAO] = now()->toDateTimeString();
        }

        parent::__construct($attributes);
    }

}

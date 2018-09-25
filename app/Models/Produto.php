<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;

class Produto extends Model
{
    use Uuids;

    protected $fillable=[
      'nome','codigo','codigo_barras', 'grupo_id', 'descricao', 'ativo', 'comissao','empresa_id','user_id'
    ];
}

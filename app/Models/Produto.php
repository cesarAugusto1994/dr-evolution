<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;

class Produto extends Model
{
    use Uuids;

    protected $fillable=[
      'nome','codigo','codigo_barras', 'grupo_id', 'descricao', 'ativo', 'comissao','empresa_id','user_id','peso','comprimento','altura','largura'
    ];

    public function fornecedores()
    {
        return $this->hasMany('App\Models\Produto\Fornecedor', 'produto_id');
    }

    public function precificacao()
    {
        return $this->hasOne('App\Models\Produto\Precificacao', 'produto_id');
    }

    public function grupo()
    {
        return $this->belongsTo('App\Models\Produto\Grupo', 'grupo_id');
    }

    public function extras()
    {
        return $this->hasMany('App\Models\Produto\Extra', 'produto_id');
    }
}

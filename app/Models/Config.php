<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $fillable = ['nome', 'descricao', 'slug', 'valor','ativo', 'tipo_id'];

    public function tipo()
    {
        return $this->belongsTo('App\Models\Config\Tipo', 'tipo_id');
    }
}

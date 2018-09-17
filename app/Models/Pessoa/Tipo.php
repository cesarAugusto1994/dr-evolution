<?php

namespace App\Models\Pessoa;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $table = 'tipo_pessoa';

    protected $fillable = ['nome'];
}

<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $table = 'configs_campo_tipo';

    protected $fillable = ['nome', 'ativo'];
}

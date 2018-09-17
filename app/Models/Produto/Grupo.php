<?php

namespace App\Models\Produto;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $fillable=['nome','grupo_pai','empresa_id','user_id'];
}

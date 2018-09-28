<?php

namespace App\Models\Produto;

use Illuminate\Database\Eloquent\Model;

class Precificacao extends Model
{
    protected $table = 'produto_precificacao';

    protected $fillable=['custo','despesas', 'outras_despesas','produto_id','custo_final'];
}

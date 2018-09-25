<?php

namespace App\Models\Produto;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $table = 'produto_fornecedores';

    protected $fillable=['fornecedor_id','produto_id','ativo'];
}

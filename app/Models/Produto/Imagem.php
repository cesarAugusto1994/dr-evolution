<?php

namespace App\Models\Produto;

use Illuminate\Database\Eloquent\Model;

class Imagem extends Model
{
    protected $table = 'produto_imagens';
    
    protected $fillable=['ativo','descricao','produto_id','link'];
}

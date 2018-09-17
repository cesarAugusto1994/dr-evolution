<?php

namespace App\Models\Produto;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;

class ValorVenda extends Model
{
    use Uuids;
    
    protected $table = 'valores_venda';

    protected $fillable = [
      'nome', 'porcentagem', 'empresa_id'
    ];
}

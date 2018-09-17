<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;

class Funcionario extends Model
{
    use Uuids;

    protected $table = 'funcionarios';

    protected $dates = ['nascimento'];

    protected $fillable = [
      'nome', 'email', 'nif', 'cidade',
      'endereco', 'telefone', 'celular',
      'ativo', 'avatar', 'comissao',
      'tipo_pessoa_id', 'empresa_id',
      'sexo', 'observacoes', 'nascimento'
    ];
}

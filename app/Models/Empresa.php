<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;

class Empresa extends Model
{
    use Uuids;

    protected $fillable = ['nome', 'email', 'nif', 'cidade', 'endereco', 'telefone', 'celular', 'ativo', 'logo', 'cambio'];
}

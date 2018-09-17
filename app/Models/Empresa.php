<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use App\Models\Pessoa\Tipo;

class Empresa extends Model
{
    use Uuids;

    protected $fillable = ['nome', 'email', 'nif', 'cidade', 'endereco', 'telefone', 'celular', 'ativo', 'logo', 'cambio', 'tipo_pessoa_id'];

    public function tipo()
    {
        return $this->belongsTo(Tipo::class, 'tipo_pessoa_id');
    }
}

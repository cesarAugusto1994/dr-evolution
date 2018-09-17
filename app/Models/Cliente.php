<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Emadadly\LaravelUuid\Uuids;
use App\Models\Pessoa\Tipo;

class Cliente extends Model
{
    use Uuids;

    protected $fillable = ['nome', 'email', 'nif', 'cidade', 'endereco', 'telefone', 'celular', 'ativo', 'avatar', 'cambio', 'tipo_pessoa_id', 'empresa_id', 'limite_divida'];

    public function tipo()
    {
        return $this->belongsTo(Tipo::class, 'tipo_pessoa_id');
    }
}

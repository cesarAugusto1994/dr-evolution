<?php

namespace App\Models\Produto;

use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    protected $table = 'extras_produto';

    protected $fillable=['valor','produto_id','extra_id'];
}

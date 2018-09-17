<?php

use Illuminate\Database\Seeder;
use App\Models\Pessoa\Tipo;

class TipoPessoatableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $itens = [
          'Pessoa Jurídica',
          'Pessoa Física',
          'Estrangeiro'
        ];

        foreach ($itens as $key => $item) {
            Tipo::create(['nome' => $item]);
        }
    }
}

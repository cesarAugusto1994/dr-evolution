<?php

use Illuminate\Database\Seeder;
use App\Models\Config\Tipo;
use App\Models\Config;

class ConfigsTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $itens = ['text','boolean','file','select'];

        foreach ($itens as $key => $item) {
            Tipo::create(['nome'=>$item]);
        }

        $itens = [
          [
            'nome' => 'Nome Site',
            'descricao' => 'Nome do Site',
            'slug' => str_slug('Nome Site'),
            'valor' => 'Imobiliaria',
            'tipo_id' => 1,
            'deletar' => false
          ],
          [
            'nome' => 'Logo Site',
            'descricao' => 'Logo Site',
            'slug' => str_slug('Logo Site'),
            'valor' => '/',
            'tipo_id' => 1,
            'deletar' => false
          ],
          [
            'nome' => 'Logo Aplicação',
            'descricao' => 'Logo da Aplicação',
            'slug' => str_slug('Logo Aplicacao'),
            'valor' => '/',
            'tipo_id' => 3,
            'deletar' => false
          ],
          [
            'nome' => 'Logo Minificado Aplicação',
            'descricao' => 'Logo Minificado da Aplicação',
            'slug' => str_slug('Logo Min Aplicacao'),
            'valor' => '/',
            'tipo_id' => 3,
            'deletar' => false
          ],
        ];

        foreach ($itens as $key => $item) {
            Config::create($item);
        }
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFornecedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->increments('id');

            $table->string('codigo')->nullable();
            $table->string('nome');
            $table->string('email')->nullable();
            $table->string('avatar')->nullable();
            $table->string('nif')->nullable();
            $table->float('limite_divida')->default(0);
            $table->string('cidade')->nullable();
            $table->string('endereco')->nullable();
            $table->string('telefone')->nullable();
            $table->string('celular')->nullable();

            $table->integer('tipo_pessoa_id')->unsigned();
            $table->foreign('tipo_pessoa_id')->references('id')->on('tipo_pessoa');

            $table->integer('empresa_id')->unsigned();
            $table->foreign('empresa_id')->references('id')->on('empresas');

            $table->boolean('ativo')->default(true);
            $table->uuid('uuid');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fornecedores');
    }
}

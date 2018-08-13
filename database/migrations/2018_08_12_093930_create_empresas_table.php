<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nome');
            $table->string('email');
            $table->string('logo')->nullable();
            $table->string('nif')->nullable();
            $table->float('cambio')->default(0);

            $table->string('cidade')->nullable();
            $table->string('endereco')->nullable();

            $table->string('telefone')->nullable();
            $table->string('celular')->nullable();

            $table->boolean('ativo')->default(true);
            $table->uuid('uuid');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}

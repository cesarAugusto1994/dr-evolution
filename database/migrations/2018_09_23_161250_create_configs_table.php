<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('configs_campo_tipo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });

        Schema::create('configs', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nome');
            $table->string('slug')->index();
            $table->string('descricao')->nullable();
            $table->string('valor')->nullable();

            $table->integer('tipo_id')->unsigned();
            $table->foreign('tipo_id')->references('id')->on('configs_campo_tipo');

            $table->boolean('deletar')->default(true);

            $table->boolean('ativo')->default(true);

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
        Schema::dropIfExists('configs');
    }
}

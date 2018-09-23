<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extras', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nome');

            $table->integer('empresa_id')->unsigned();
            $table->foreign('empresa_id')->references('id')->on('empresas');

            $table->boolean('ativo')->default(true);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('extras_produto', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('extra_id')->unsigned();
            $table->foreign('extra_id')->references('id')->on('extras');

            $table->integer('produto_id')->unsigned();
            $table->foreign('produto_id')->references('id')->on('empresas');

            $table->string('valor');

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
        Schema::dropIfExists('extras_produto');
        Schema::dropIfExists('extras');
    }
}

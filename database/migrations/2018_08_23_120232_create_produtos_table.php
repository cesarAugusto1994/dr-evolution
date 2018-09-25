<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valores_venda', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->float('porcentagem', 12,2);
            $table->integer('empresa_id')->unsigned();
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->uuid('uuid');
            $table->boolean('ativo')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('codigo');
            $table->string('codigo_barras')->nullable();
            $table->integer('grupo_id')->unsigned()->index();
            $table->foreign('grupo_id')->references('id')->on('grupos');
            $table->boolean('movimenta_estoque')->default(true);
            $table->boolean('possui_variacoes')->default(false);
            $table->float('peso')->default(0.00);
            $table->float('largura')->default(0.00);
            $table->float('altura')->default(0.00);
            $table->float('comprimento')->default(0.00);
            $table->longText('descricao')->nullable();
            $table->float('comissao')->nullable();
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('empresa_id')->unsigned();
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->uuid('uuid');
            $table->boolean('ativo')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('produto_estoque', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('produto_id')->unsigned()->index();
            $table->foreign('produto_id')->references('id')->on('produtos');

            $table->float('estoque_minimo')->default(0.00);
            $table->float('estoque_maximo')->default(0.00);
            $table->float('estoque_atual')->default(0.00);

            $table->boolean('ativo')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('produto_variacao', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('referencia');
            $table->integer('codigo')->unique()->index();

            $table->integer('produto_id')->unsigned()->index();
            $table->foreign('produto_id')->references('id')->on('produtos');

            $table->integer('grade_variacao_id')->unsigned()->index();
            $table->foreign('grade_variacao_id')->references('id')->on('grade_variacoes');

            $table->boolean('ativo')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('produto_variacao_estoque', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('produto_variacao_id')->index();

            $table->float('estoque_minimo')->default(0.00);
            $table->float('estoque_maximo')->default(0.00);
            $table->float('estoque_atual')->default(0.00);

            $table->boolean('ativo')->default(true);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('produto_precificacao', function (Blueprint $table) {
            $table->increments('id');
            $table->float('custo')->default(0.00);
            $table->float('despesas')->default(0.00);
            $table->float('outras_despesas')->default(0.00);
            $table->float('custo_final')->default(0.00);
            $table->integer('produto_id')->unsigned()->index();
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->boolean('ativo')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('produto_imagens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao');
            $table->string('link');
            $table->integer('produto_id')->unsigned()->index();
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->boolean('ativo')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('produto_particularidades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('produto_id')->unsigned()->index();
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->integer('particularidade_id')->unsigned()->index();
            $table->foreign('particularidade_id')->references('id')->on('particularidades');
            $table->string('valor');
            $table->boolean('ativo')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('produto_fornecedores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('produto_id')->unsigned()->index();
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->integer('fornecedor_id')->unsigned()->index();
            $table->foreign('fornecedor_id')->references('id')->on('fornecedores');
            $table->boolean('ativo')->default(true);
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
        Schema::dropIfExists('produto_imagens');
        Schema::dropIfExists('produtos');
    }
}

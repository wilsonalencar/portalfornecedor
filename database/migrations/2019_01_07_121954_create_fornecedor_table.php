<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFornecedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedor', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('empresaid');
            $table->string('razao_social', 255);
            $table->string('nome_fantasia', 30);
            $table->char('tipo', 1);
            $table->string('cnpj_cpf', 20);
            $table->string('insc_estadual', 50);
            $table->string('insc_municipal', 50);
            $table->string('endereco', 255);
            $table->string('complemento', 255)->nullable();
            $table->string('cod_municipio', 255);
            $table->string('cep', 10);  
            $table->string('telefone', 255)->nullable();
            $table->string('contato', 255)->nullable();
            $table->string('email', 255);
            $table->char('status', 1)->default('A');
            $table->string('usuario', 255);
            $table->date('data_cadastro');
            $table->date('data_alteracao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fornecedor');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('usuarioid')->unique();
            $table->string('nome', 255);
            $table->string('email', 255);
            $table->integer('id_perfilusuario');
            $table->string('password', 100);
            $table->char('reset_senha', 1)->default('N');
            $table->string('usuario', 255);
            $table->date('data_criacao');
            $table->date('data_alteracao');
            $table->char('status', 1)->default('A');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}

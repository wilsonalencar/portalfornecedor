<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdemcompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordemcompra', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('empresaid');
            $table->integer('estabid');
            $table->integer('fornecedorid');
            $table->string('ordemcompra', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordemcompra');
    }
}

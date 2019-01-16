<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemnotafiscalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itemnotafiscal', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('notafiscal_id');
            $table->decimal('quantidade', 10, 2);
            $table->decimal('unidade', 10, 2);
            $table->string('descricao', 255);
            $table->decimal('valor_unitario_item', 10, 2);
            $table->decimal('valor_total_item', 10, 2);
            $table->decimal('aql_iss', 10, 2);
            $table->decimal('vlr_iss', 10, 2);
            $table->decimal('alq_irrf', 10, 2);
            $table->decimal('vlr_irrf', 10, 2);
            $table->decimal('aql_outros', 10, 2);
            $table->decimal('vlr_outros', 10, 2);
            $table->decimal('aql_inss', 10, 2);
            $table->decimal('vlr_inss', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itemnotafiscal');
    }
}

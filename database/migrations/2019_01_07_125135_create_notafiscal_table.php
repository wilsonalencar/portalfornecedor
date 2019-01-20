<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotafiscalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notafiscal', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('empresaid');
            $table->integer('estabid');
            $table->string('nota_fiscal', 255);
            $table->string('serie', 5);
            $table->integer('fornecedorid');
            $table->integer('ordemcompraid');
            $table->date('data_emissao');
            $table->date('data_lancamento');
            $table->string('observacao', 255)->nullable();
            $table->decimal('valor_total_bruto', 10, 2);
            $table->decimal('valor_total_liquido', 10, 2);
            $table->decimal('vlr_iss', 10, 2);
            $table->decimal('vlr_irrf', 10, 2);
            $table->decimal('vlr_outros', 10, 2);
            $table->decimal('vlr_inss', 10, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notafiscal');
    }
}

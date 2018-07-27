<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChartEditionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chart_edition', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('number')->comment('Numero de edicion de la carta');
            $table->year('year')->comment('Año de edicion de la carta');
            $table->timestamps();
            $table->enum('state', array('A','I'))->default('A')->comment('Estado del registro. Puede ser Activo, Inactivo');
            $table->integer('chart_id')->unsigned();

            $table->foreign('chart_id')
                  ->references('id')->on('chart');

            $table->unique(['number', 'year', 'chart_id'], 'number_year_chart_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chart_edition');
    }
}

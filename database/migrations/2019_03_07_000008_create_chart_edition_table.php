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
            $table->integer('edition')->comment('Numero de edicion de la carta');
            $table->year('year');
            $table->timestamps();
            $table->integer('chart_id')->unsigned();

            $table->foreign('chart_id')
                  ->references('id')->on('chart')
                  ->onDelete('cascade');

            $table->unique(['edition', 'year', 'chart_id'], 'edition_year_chart_UNIQUE');
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

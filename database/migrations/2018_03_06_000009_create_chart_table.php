<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chart', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('number', 45)->comment('Numero de la carta');
            $table->string('purpose', 100)->comment('El proposito es la clasificacion segun el objetivo de la carta');
            $table->timestamps();
            $table->string('user', 100)->comment('Nombre de usuario que manipulo le registro');
            
            $table->unique(['number'], 'number_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chart');
    }
}

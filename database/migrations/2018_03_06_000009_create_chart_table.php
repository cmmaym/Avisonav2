<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Grimzy\LaravelMysqlSpatial\Schema\Blueprint;
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
            $table->string('name', 100)->comment('Numero de la carta');
            $table->string('scale', 45)->comment('Escala de la carta');
            $table->mediumText('purpose')->comment('El proposito es la clasificacion segun el objetivo de la carta');
            $table->timestamps();
            $table->string('created_by', 100);
            $table->string('updated_by', 100);
            $table->geometry('area')->nullable();
            
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('chart');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

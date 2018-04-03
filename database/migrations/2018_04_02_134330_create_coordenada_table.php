<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoordenadaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coordenada', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('latitud', 100);
            $table->string('longitud', 100);
            $table->integer('altitud');
            $table->integer('alcance');
            $table->integer('cantidad');
            $table->timestamps();
            $table->enum('estado', array('A','I'))->default('A')->comment('Estado de la coordenada. Puede ser Activo, Inactivo');
            $table->integer('ayuda_id')->unsigned();

            $table->foreign('ayuda_id')
                ->references('id')->on('ayuda')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coordenada');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carta', function (Blueprint $table) {
            $table->increments('carta_id')->unsigned();
            $table->string('numero', 45)->comment('Numero de la carta');
            $table->integer('edicion')->comment('Numero de edicion de la carta');
            $table->year('ano')->comment('Año de publicacion de la carta');
            $table->string('cod_ide', 45)->comment('Codigo que identifica a un grupo de registros que unicamente se diferencian por el lenguaje pero que son iguales');
            $table->timestamps();
            $table->enum('estado', array('A','I'))->default('A')->comment('Estado del registro. Puede ser Activo, Inactivo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carta');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoCaracterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_caracter', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('nombre', 100)->comment('Nombre del tipo de caracter');            
            $table->timestamps();
            $table->enum('estado', array('A','I'))->default('A')->comment('Estado del tipo. Puede ser Activo, Inactivo');
            $table->integer('idioma_id')->unsigned();

            $table->foreign('idioma_id')
                  ->references('id')->on('idioma')
                  ->onDelete('cascade');

            $table->unique(['nombre', 'idioma_id'], 'nombre_idioma_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_caracter');
    }
}

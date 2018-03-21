<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdiomaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('idioma', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('nombre', 45)->comment('Nombre del idioma');
            $table->string('alias', 45)->comment('Alias o nombre corto del idioma');
            $table->timestamps();
            $table->enum('estado', array('A','I'))->default('A')->comment('Estado del idioma. Puede ser Activo, Inactivo');

            $table->unique(['nombre', 'alias'], 'nombre_alias_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('idioma');
    }
}

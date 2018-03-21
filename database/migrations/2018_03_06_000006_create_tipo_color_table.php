<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoColorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_color', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('color', 45)->comment('Nombre del color');
            $table->string('alias', 45)->comment('Abreviacion del color');            
            $table->timestamps();
            $table->enum('estado', array('A','I'))->comment('Estado del tipo color. Puede ser Activo, Inactivo');
            $table->integer('idioma_id')->unsigned();

            $table->foreign('idioma_id')
                  ->references('id')->on('idioma')
                  ->onDelete('cascade');

            $table->unique(['color', 'alias', 'idioma_id'], 'color_alias_idioma_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_color');
    }
}

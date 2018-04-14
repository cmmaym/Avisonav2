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
            $table->integer('language_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();

            $table->foreign('language_id')
                  ->references('id')->on('language')
                  ->onDelete('cascade');

            $table->foreign('parent_id')
                  ->references('id')->on('tipo_color')
                  ->onDelete('cascade');

            $table->unique(['color', 'alias', 'language_id'], 'color_alias_language_UNIQUE');
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

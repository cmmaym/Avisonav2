<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoLuzTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_luz', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('clase', 100)->comment('Clase de luz');
            $table->string('alias', 45)->comment('Abreviatura de la clase');
            $table->mediumText('descripcion')->comment('Descripcion breve de la clase de luz');
            $table->string('illustracion', 45)->nullable()->comment('Imagen de la clase de luz');            
            $table->timestamps();
            $table->enum('estado', array('A','I'))->default('A')->comment('Estado del tipo luz. Puede ser Activo, Inactivo');
            $table->integer('language_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();

            $table->foreign('language_id')
                  ->references('id')->on('language')
                  ->onDelete('cascade');

            $table->foreign('parent_id')
                  ->references('id')->on('tipo_luz')
                  ->onDelete('cascade');

            $table->unique(['clase', 'alias', 'language_id'], 'clase_alias_language_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_luz');
    }
}

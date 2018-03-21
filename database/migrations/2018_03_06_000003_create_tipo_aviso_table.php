<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoAvisoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_aviso', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('nombre', 100)->comment('Nombre del tipo de aviso');
            $table->timestamps();            
            $table->enum('estado', array('A','I'))->default('A')->comment('Estado del tipo. Puede ser Activo, Inactivo');
            $table->integer('idioma_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();

            $table->foreign('idioma_id')
                  ->references('id')->on('idioma')
                  ->onDelete('cascade');

            $table->foreign('parent_id')
                  ->references('id')->on('tipo_aviso')
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
        Schema::dropIfExists('tipo_aviso');
    }
}

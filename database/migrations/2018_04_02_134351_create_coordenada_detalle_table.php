<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoordenadaDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coordenada_detalle', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('descripcion')->comment('Descripcion referente a los cambios en las coordenadas de la ayuda');
            $table->mediumText('observacion')->comment('Observacion referente a los cambios en las coordenadas de la ayuda');
            $table->timestamps();
            $table->enum('estado', array('A','I'))->default('A')->comment('Estado de la coordenada detalle. Puede ser Activo, Inactivo');
            $table->integer('coordenada_id')->unsigned();
            $table->integer('tipo_luz_id')->unsigned();
            $table->integer('color_type_id')->unsigned();
            $table->integer('language_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();

            $table->foreign('coordenada_id')
                ->references('id')->on('coordenada')
                ->onDelete('cascade');

            $table->foreign('tipo_luz_id')
                ->references('id')->on('tipo_luz')
                ->onDelete('cascade');
            
            $table->foreign('color_type_id')
                ->references('id')->on('color_type')
                ->onDelete('cascade');
            
            $table->foreign('language_id')
                ->references('id')->on('language')
                ->onDelete('cascade');
            
            $table->foreign('parent_id')
                ->references('id')->on('coordenada_detalle')
                ->onDelete('cascade');

            $table->unique(['coordenada_id', 'language_id'], 'coordenada_language_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coordenada_detalle');
    }
}

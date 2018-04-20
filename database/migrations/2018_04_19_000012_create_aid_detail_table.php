<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAidDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aid_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('description')->comment('Descripcion referente a los cambios en las coordenadas de la ayuda');
            $table->mediumText('observation')->comment('Observacion referente a los cambios en las coordenadas de la ayuda');
            $table->timestamps();
            $table->enum('state', array('A','I'))->default('A')->comment('Estado de la coordenada detalle. Puede ser Activo, Inactivo');
            $table->integer('aid_id')->unsigned();
            $table->integer('coordinate_id')->unsigned();
            $table->integer('light_type_id')->unsigned();
            $table->integer('color_type_id')->unsigned();
            $table->integer('language_id')->unsigned();
            $table->integer('novelty_type_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();

            $table->foreign('aid_id')
                ->references('id')->on('aid')
                ->onDelete('cascade');
            
            $table->foreign('coordinate_id')
                ->references('id')->on('coordinate')
                ->onDelete('cascade');

            $table->foreign('light_type_id')
                ->references('id')->on('light_type')
                ->onDelete('cascade');
            
            $table->foreign('color_type_id')
                ->references('id')->on('color_type')
                ->onDelete('cascade');
            
            $table->foreign('novelty_type_id')
                ->references('id')->on('novelty_type')
                ->onDelete('cascade');

            $table->foreign('language_id')
                ->references('id')->on('language')
                ->onDelete('cascade');
            
            $table->foreign('parent_id')
                ->references('id')->on('aid_detail')
                ->onDelete('cascade');

            $table->unique(['aid_id', 'language_id'], 'aid_language_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coordinate_detail');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLightTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('light_type', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('class', 100)->comment('Clase de luz');
            $table->string('alias', 45)->comment('Abreviatura de la clase');
            $table->mediumText('description')->comment('Descripcion breve de la clase de luz');
            $table->string('illustration', 45)->nullable()->comment('Imagen de la clase de luz');            
            $table->timestamps();
            $table->enum('state', array('A','I'))->default('A')->comment('Estado del tipo luz. Puede ser Activo, Inactivo');
            $table->integer('language_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();

            $table->foreign('language_id')
                  ->references('id')->on('language')
                  ->onDelete('cascade');

            $table->foreign('parent_id')
                  ->references('id')->on('light_type')
                  ->onDelete('cascade');

            $table->unique(['class', 'alias', 'language_id'], 'class_alias_language_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('light_type');
    }
}

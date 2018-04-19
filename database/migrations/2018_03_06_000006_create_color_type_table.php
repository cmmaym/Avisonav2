<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColorTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('color_type', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('color', 45)->comment('Nombre del color');
            $table->string('alias', 45)->comment('Abreviacion del color');
            $table->timestamps();
            $table->enum('state', array('A','I'))->comment('Estado del tipo color. Puede ser Activo, Inactivo');
            $table->integer('language_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();

            $table->foreign('language_id')
                  ->references('id')->on('language')
                  ->onDelete('cascade');

            $table->foreign('parent_id')
                  ->references('id')->on('color_type')
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
        Schema::dropIfExists('color_type');
    }
}

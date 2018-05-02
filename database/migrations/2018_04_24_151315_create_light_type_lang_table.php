<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLightTypeLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('light_type_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('class', 100)->comment('Clase de luz');
            $table->mediumText('description')->comment('Descripcion breve de la clase de luz');
            $table->timestamps();
            $table->integer('language_id')->unsigned();
            $table->integer('light_type_id')->unsigned()->nullable();

            $table->foreign('language_id')
                  ->references('id')->on('language')
                  ->onDelete('cascade');

            $table->foreign('light_type_id')
                  ->references('id')->on('light_type')
                  ->onDelete('cascade');

            $table->unique(['language_id', 'light_type_id'], 'language_light_type_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('light_type_lang');
    }
}

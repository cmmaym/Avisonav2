<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLightClassLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('light_class_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('class', 100)->comment('Clase de luz');
            $table->mediumText('description')->comment('Descripcion breve de la clase de luz');
            $table->timestamps();
            $table->integer('language_id')->unsigned();
            $table->integer('light_class_id')->unsigned()->nullable();

            $table->foreign('language_id')
                  ->references('id')->on('language');

            $table->foreign('light_class_id')
                  ->references('id')->on('light_class')
                  ->onDelete('cascade');

            $table->unique(['language_id', 'light_class_id'], 'language_light_class_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('light_class_lang');
    }
}

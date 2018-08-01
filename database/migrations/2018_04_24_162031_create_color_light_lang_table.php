<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColorLightLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('color_light_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('color', 45)->comment('Nombre del color');
            $table->string('alias', 45)->comment('Abreviacion del color');
            $table->timestamps();
            $table->integer('language_id')->unsigned();
            $table->integer('color_light_id')->unsigned();

            $table->foreign('language_id')
                  ->references('id')->on('language');

            $table->foreign('color_light_id')
                  ->references('id')->on('color_light')
                  ->onDelete('cascade');

            $table->unique(['language_id', 'color_light_id'], 'language_color_light_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('color_light_lang');
    }
}

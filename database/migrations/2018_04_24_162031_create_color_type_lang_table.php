<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColorTypeLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('color_type_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('color', 45)->comment('Nombre del color');
            $table->string('alias', 45)->comment('Abreviacion del color');
            $table->timestamps();
            $table->integer('language_id')->unsigned();
            $table->integer('color_type_id')->unsigned()->nullable();

            $table->foreign('language_id')
                  ->references('id')->on('language')
                  ->onDelete('cascade');

            $table->foreign('color_type_id')
                  ->references('id')->on('color_type')
                  ->onDelete('cascade');

            $table->unique(['language_id', 'color_type_id'], 'language_color_type_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('color_type_lang');
    }
}

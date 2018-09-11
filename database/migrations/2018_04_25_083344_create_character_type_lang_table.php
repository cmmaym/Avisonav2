<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterTypeLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_type_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->comment('Nombre del tipo de caracter');            
            $table->timestamps();
            $table->string('created_by', 100);
            $table->string('updated_by', 100);
            $table->integer('language_id')->unsigned();
            $table->integer('character_type_id')->unsigned()->nullable();

            $table->foreign('language_id')
                  ->references('id')->on('language');

            $table->foreign('character_type_id')
                  ->references('id')->on('character_type')
                  ->onDelete('cascade');

            $table->unique(['language_id', 'character_type_id'], 'language_character_type_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('character_type_lang');
    }
}

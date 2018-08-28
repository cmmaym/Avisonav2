<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoveltyLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novelty_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('description')->nullable()->comment('Descripcion acerca de la novedad');
            $table->timestamps();
            $table->integer('novelty_id')->unsigned();            
            $table->integer('language_id')->unsigned();

            $table->foreign('novelty_id')
                  ->references('id')->on('novelty')
                  ->onDelete('cascade');

            $table->foreign('language_id')
                ->references('id')->on('language');

            $table->unique(['novelty_id', 'language_id'], 'novelty_language_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('novelty_lang');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoveltyTypeLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novelty_type_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->comment('Nombre del tipo de aviso');
            $table->mediumText('description')->nullable();
            $table->timestamps();
            $table->string('created_by', 100);
            $table->string('updated_by', 100);
            $table->integer('language_id')->unsigned();
            $table->integer('novelty_type_id')->unsigned();

            $table->foreign('language_id')
                  ->references('id')->on('language');
            
            $table->foreign('novelty_type_id')
                  ->references('id')->on('novelty_type')
                  ->onDelete('cascade');

            $table->unique(['language_id', 'novelty_type_id'], 'language_novelty_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('novelty_type_lang');
    }
}

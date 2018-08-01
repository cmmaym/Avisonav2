<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopMarkLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('top_mark_lang', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('illustration', 45)->nullable()->comment('Imagen de la marca de tope');
            $table->mediumText('description');
            $table->timestamps();
            $table->integer('language_id')->unsigned();
            $table->integer('top_mark_id')->unsigned();

            $table->foreign('language_id')
                  ->references('id')->on('language');
            
            $table->foreign('top_mark_id')
                  ->references('id')->on('top_mark')
                  ->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('top_mark_lang');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

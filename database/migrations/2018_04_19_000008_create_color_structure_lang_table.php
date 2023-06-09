<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColorStructureLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('color_structure_lang', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 45)->comment('Nombre del color');
            $table->timestamps();
            $table->string('created_by', 100);
            $table->string('updated_by', 100);
            $table->integer('color_structure_id')->unsigned();
            $table->integer('language_id')->unsigned();

            $table->foreign('language_id')
                  ->references('id')->on('language');

            $table->foreign('color_structure_id')
                  ->references('id')->on('color_structure')
                  ->onDelete('cascade');

            $table->unique(['language_id', 'color_structure_id'], 'language_color_structure_UNIQUE');
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
        Schema::dropIfExists('color_structure_lang');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

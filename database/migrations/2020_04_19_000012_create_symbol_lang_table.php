<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSymbolLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('symbol_lang', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 100);
            $table->mediumText('observation')->nullable();
            $table->timestamps();
            $table->string('created_by', 100);
            $table->string('updated_by', 100);
            $table->integer('symbol_id')->unsigned();
            $table->integer('language_id')->unsigned();
            
            $table->foreign('symbol_id')
                  ->references('id')->on('symbol')
                  ->onDelete('cascade');

            $table->foreign('language_id')
                  ->references('id')->on('language');

            $table->unique(['symbol_id', 'language_id'], 'symbol_language_UNIQUE');
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
        Schema::dropIfExists('symbol_lang');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
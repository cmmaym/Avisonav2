<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSymbolNoveltyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('symbol_novelty', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('novelty_id')->unsigned();
            $table->integer('symbol_id')->unsigned();
            $table->integer('height_id')->unsigned()->nullable();
            $table->integer('nominal_scope_id')->unsigned()->nullable();
            $table->integer('period_id')->unsigned()->nullable();
            $table->timestamps();
            $table->string('created_by', 100);
            $table->string('updated_by', 100);
            
            $table->foreign('novelty_id')
                  ->references('id')->on('novelty')
                  ->onDelete('cascade');

            $table->foreign('symbol_id')
                  ->references('id')->on('symbol');
            
            $table->foreign('height_id')
                  ->references('id')->on('height');
            
            $table->foreign('nominal_scope_id')
                  ->references('id')->on('nominal_scope');
            
            $table->foreign('period_id')
                  ->references('id')->on('period');

            $table->unique(['novelty_id', 'symbol_id'], 'novelty_symbol_UNIQUE');
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
        Schema::dropIfExists('symbol_novelty');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
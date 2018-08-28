<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSymbolChartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('symbol_chart', function (Blueprint $table) {
            $table->integer('symbol_id')->unsigned();
            $table->integer('chart_id')->unsigned();
            $table->timestamps();

            $table->foreign('symbol_id')
                ->references('id')->on('symbol')
                ->onDelete('cascade');
            
            $table->foreign('chart_id')
                ->references('id')->on('chart')
                ->onDelete('cascade');

            $table->unique(['symbol_id', 'chart_id'], 'symbol_chart_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('symbol_chart');
    }
}

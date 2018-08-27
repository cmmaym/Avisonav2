<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticeChartEditionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice_chart_edition', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('notice_id')->unsigned();
            $table->integer('chart_edition_id')->unsigned();
            $table->timestamps();

            $table->foreign('notice_id')
                ->references('id')->on('notice')
                ->onDelete('cascade');

            $table->foreign('chart_edition_id')
                ->references('id')->on('chart_edition')
                ->onDelete('cascade');

            $table->unique(['notice_id', 'chart_edition_id'], 'notice_chart_edition_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notice_chart_edition');
    }
}

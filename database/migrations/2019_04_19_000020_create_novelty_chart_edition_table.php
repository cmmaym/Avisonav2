<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoveltyChartEditionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novelty_chart_edition', function (Blueprint $table) {
            $table->integer('novelty_id')->unsigned();
            $table->integer('chart_edition_id')->unsigned();
            $table->timestamps();
            $table->string('created_by', 100);
            $table->string('updated_by', 100);

            $table->foreign('novelty_id')
                ->references('id')->on('novelty')
                ->onDelete('cascade');

            $table->foreign('chart_edition_id')
                ->references('id')->on('chart_edition')
                ->onDelete('cascade');

            $table->unique(['novelty_id', 'chart_edition_id'], 'novelty_chart_edition_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('novelty_chart_edition');
    }
}

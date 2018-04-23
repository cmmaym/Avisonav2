<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAidChartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aid_chart', function (Blueprint $table) {
            $table->integer('aid_id')->unsigned();
            $table->integer('chart_id')->unsigned();
            $table->integer('aid_detail_id')->unsigned();
            $table->integer('chart_edition_id')->unsigned();
            $table->timestamps();

            $table->foreign('aid_id')
                ->references('id')->on('aid')
                ->onDelete('cascade');
            
            $table->foreign('chart_id')
                ->references('id')->on('chart')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aid_chart');
    }
}

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
            $table->timestamps();

            $table->foreign('aid_id')
                ->references('id')->on('aid')
                ->onDelete('cascade');
            
            $table->foreign('chart_id')
                ->references('id')->on('chart')
                ->onDelete('cascade');

            $table->unique(['aid_id', 'chart_id'], 'aid_chart_UNIQUE');
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChartPurposeLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chart_purpose_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description', 100);
            $table->timestamps();
            $table->string('created_by', 100);
            $table->string('updated_by', 100);
            $table->integer('language_id')->unsigned();
            $table->integer('chart_purpose_id')->unsigned();

            $table->foreign('language_id')
                  ->references('id')->on('language')
                  ->onDelete('cascade');
            
            $table->foreign('chart_purpose_id')
                  ->references('id')->on('chart_purpose')
                  ->onDelete('cascade');

            $table->unique(['language_id', 'chart_purpose_id'], 'language_chart_purpose_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chart_purpose_lang');
    }
}

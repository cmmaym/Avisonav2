<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvisoCartaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aviso_carta', function (Blueprint $table) {
            $table->integer('notice_id')->unsigned();
            $table->integer('chart_id')->unsigned();
            $table->timestamps();

            $table->foreign('notice_id')
                ->references('id')->on('notice')
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
        Schema::dropIfExists('aviso_carta');
    }
}

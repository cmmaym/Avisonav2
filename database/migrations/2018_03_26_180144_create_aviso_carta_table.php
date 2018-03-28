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
            $table->integer('aviso_id')->unsigned();
            $table->integer('carta_id')->unsigned();
            $table->timestamps();

            $table->foreign('aviso_id')
                ->references('id')->on('aviso')
                ->onDelete('cascade');

            $table->foreign('carta_id')
                ->references('id')->on('carta')
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

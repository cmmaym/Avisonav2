<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSequenceFlashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sequence_flashes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('on', 45)->comment('Encendido');
            $table->string('off', 45)->comment('Apagado');
            $table->timestamps();
            $table->integer('aid_id')->unsigned();

            $table->foreign('aid_id')
                  ->references('id')->on('aid')
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
        Schema::dropIfExists('sequence_flashes');
    }
}

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
            $table->float('on', 3)->comment('Encendido');
            $table->float('off', 3)->comment('Apagado');
            $table->timestamps();
            $table->string('created_by', 100);
            $table->string('updated_by', 100);
            $table->integer('period_id')->unsigned();

            $table->foreign('period_id')
                  ->references('id')->on('period')
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

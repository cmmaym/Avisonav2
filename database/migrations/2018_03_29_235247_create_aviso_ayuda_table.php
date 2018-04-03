<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvisoAyudaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aviso_ayuda', function (Blueprint $table) {
            $table->integer('aviso_id')->unsigned();
            $table->integer('ayuda_id')->unsigned();
            $table->integer('coordenada_id');
            $table->timestamps();

            $table->foreign('aviso_id')
                ->references('id')->on('aviso')
                ->onDelete('cascade');

            $table->foreign('ayuda_id')
                ->references('id')->on('ayuda')
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
        Schema::dropIfExists('aviso_ayuda');
    }
}

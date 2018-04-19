<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvisoDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aviso_detalle', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('observacion')->comment('Observacion acerca del aviso');
            $table->timestamps();
            $table->integer('aviso_id')->unsigned();            
            $table->integer('character_type_id')->unsigned();
            $table->integer('language_id')->unsigned();

            $table->foreign('aviso_id')
                ->references('id')->on('aviso')
                ->onDelete('cascade');

            $table->foreign('character_type_id')
                ->references('id')->on('character_type')
                ->onDelete('cascade');

            $table->foreign('language_id')
                ->references('id')->on('language')
                ->onDelete('cascade');

            $table->unique(['aviso_id', 'language_id'], 'aviso_language_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aviso_detalle');
    }
}

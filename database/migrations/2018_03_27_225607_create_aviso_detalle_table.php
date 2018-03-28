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
            $table->integer('tipo_aviso_id')->unsigned();
            $table->integer('tipo_caracter_id')->unsigned();
            $table->integer('idioma_id')->unsigned();

            $table->foreign('aviso_id')
                ->references('id')->on('aviso')
                ->onDelete('cascade');

            $table->foreign('tipo_aviso_id')
                ->references('id')->on('tipo_aviso')
                ->onDelete('cascade');

            $table->foreign('tipo_caracter_id')
                ->references('id')->on('tipo_caracter')
                ->onDelete('cascade');

            $table->foreign('idioma_id')
                ->references('id')->on('idioma')
                ->onDelete('cascade');

            $table->unique(['aviso_id', 'idioma_id'], 'aviso_idioma_UNIQUE');
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

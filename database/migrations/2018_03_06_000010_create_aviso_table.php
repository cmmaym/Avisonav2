<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvisoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aviso', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('num_aviso', 100)->comment('Numero del aviso');
            $table->dateTime('fecha')->comment('Fecha en la que se genero el aviso');
            $table->timestamps();
            $table->mediumText('observacion')->comment('Observacion acerca del aviso');
            $table->string('periodo',45)->comment('Periodo en el que se registro el aviso');
            $table->enum('estado',array('A','I'))->default('A')->comment('Estado del aviso. Puede ser Activo, Inactivo');            
            $table->integer('user_id')->unsigned()->comment('Usuario que creo o actualizo el regitro');
            $table->integer('entidad_id')->unsigned();
            $table->integer('tipo_carac_id')->unsigned();
            $table->integer('tipo_aviso_id')->unsigned();
            $table->integer('idioma_id')->unsigned();
            $table->integer('carta_id')->unsigned();
            
            $table->foreign('entidad_id')
                  ->references('id')->on('entidad')
                  ->onDelete('cascade');

            $table->foreign('tipo_carac_id')
                  ->references('id')->on('tipo_caracter')
                  ->onDelete('cascade');
            
            $table->foreign('tipo_aviso_id')
                  ->references('id')->on('tipo_aviso')
                  ->onDelete('cascade');

            $table->foreign('idioma_id')
                  ->references('id')->on('idioma')
                  ->onDelete('cascade');

            $table->foreign('carta_id')
                  ->references('id')->on('carta')
                  ->onDelete('cascade');


            $table->unique(['num_aviso', 'periodo', 'idioma_id'], 'num_aviso_periodo_idioma_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aviso');
    }
}

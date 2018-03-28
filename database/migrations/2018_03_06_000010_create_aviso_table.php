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
            $table->string('periodo',45)->comment('Periodo en el que se registro el aviso');
            $table->enum('estado',array('A','I'))->default('A')->comment('Estado del aviso. Puede ser Activo, Inactivo');            
            $table->integer('user_id')->unsigned()->nullable()->comment('Usuario que creo o actualizo el regitro');
            $table->integer('entidad_id')->unsigned();

            $table->foreign('entidad_id')
                  ->references('id')->on('entidad')
                  ->onDelete('cascade');

            $table->unique(['num_aviso', 'periodo'], 'num_aviso_periodo_UNIQUE');
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

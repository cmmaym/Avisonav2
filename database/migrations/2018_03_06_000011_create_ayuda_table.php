<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAyudaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ayuda', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('numero')->comment('Numero nacional - Es un numero dependiendo de la situacion geografica');
            $table->string('nombre', 45)->comment('Tipo de la ayuda o luz');
            $table->integer('version')->comment('Numero de la ultima version de la ayuda');
            $table->enum('estado', array('A','I'))->default('A')->comment('Estado de la ayuda. Puede ser Activo, Inactivo');
            $table->timestamps();
            $table->integer('user_id')->unsigned()->comment('Usuario que creo o actualizo el regitro');
            $table->integer('ubicacion_id')->unsigned();

            $table->foreign('ubicacion_id')
                ->references('id')->on('ubicacion')
                ->onDelete('cascade');

            $table->unique(['numero', 'ubicacion_id'], 'numero_ubicacion_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ayuda');
    }
}

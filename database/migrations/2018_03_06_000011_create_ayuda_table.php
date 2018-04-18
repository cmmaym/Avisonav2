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
            $table->enum('estado', array('A','I'))->default('A')->comment('Estado de la ayuda. Puede ser Activo, Inactivo');
            $table->timestamps();
            $table->integer('user_id')->unsigned()->comment('Usuario que creo o actualizo el regitro');
            $table->integer('location_id')->unsigned();

            $table->foreign('location_id')
                ->references('id')->on('location')
                ->onDelete('cascade');

            $table->unique(['numero', 'location_id'], 'numero_location_UNIQUE');
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

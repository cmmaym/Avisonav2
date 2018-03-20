<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUbicacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ubicacion', function (Blueprint $table) {
            $table->increments('ubicacion_id')->unsigned();
            $table->string('ubicacion', 100)->comment('Nombre de la ubicacion de la ayuda');
            $table->string('sub_ubicacion', 100)->nullable()->comment('Nombre de la sub ubicacion es decir la ubicacion mas espesifica donde se encuentra la ayuda');
            $table->timestamps();
            $table->enum('estado', array('A', 'I'))->default('A')->comment('Estado de la ubicacion. Puede ser Activo, Inactivo');
            $table->integer('zona_id')->unsigned();

            $table->foreign('zona_id')
                  ->references('zona_id')->on('zona')
                  ->onDelete('cascade');

            $table->unique(['ubicacion', 'zona_id'], 'ubicacion_zona_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ubicacion');
    }
}

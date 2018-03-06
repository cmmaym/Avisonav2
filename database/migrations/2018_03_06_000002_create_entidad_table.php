<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entidad', function (Blueprint $table) {
            $table->increments('entidad_id')->unsigned();
            $table->string('nombre', 100)->comment('Nombre de la entidad o usuario que reporto el aviso');
            $table->string('alias', 45)->comment('Alias o nombre corto de la entidad o usuario');
            $table->timestamps();
            $table->enum('estado', array('A','I'))->default('A')->comment('Estado de la entidad. Puede ser Activo, Inactivo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entidad');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zona', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('nombre', 100)->comment('Nombre de la zona de la novedad');
            $table->string('alias', 45)->comment('Alias del nombre de la zona');            
            $table->timestamps();
            $table->enum('estado', array('A', 'I'))->default('A')->comment('Estado la ubicacion. Puede ser Activo, Inactivo');
            $table->integer('idioma_id')->unsigned();

            $table->foreign('idioma_id')
                  ->references('id')->on('idioma')
                  ->onDelete('cascade');

            $table->unique(['nombre', 'alias', 'idioma_id'], 'nombre_alias_idoma_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zona');
    }
}

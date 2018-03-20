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
            $table->increments('zona_id')->unsigned();
            $table->string('nombre', 100)->comment('Nombre de la zona de la novedad');
            $table->string('alias', 45)->comment('Alias del nombre de la zona');
            $table->string('cod_ide', 45)->comment('Codigo que identifica a un grupo de registros que unicamente se diferencian por el lenguaje pero que son iguales');
            $table->timestamps();
            $table->enum('estado', array('A', 'I'))->default('A')->comment('Estado la ubicacion. Puede ser Activo, Inactivo');
            $table->integer('idioma_id')->unsigned();

            $table->foreign('idioma_id')
                  ->references('idioma_id')->on('idioma')
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

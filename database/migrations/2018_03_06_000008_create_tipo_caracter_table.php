<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoCaracterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_caracter', function (Blueprint $table) {
            $table->increments('tipo_carac_id')->unsigned();
            $table->string('nombre', 100)->comment('Nombre del tipo de caracter');
            $table->string('cod_ide', 45)->comment('Codigo que identifica a un grupo de registros que unicamente se diferencian por el lenguaje pero que son iguales');
            $table->timestamps();
            $table->enum('estado', array('A','I'))->default('A')->comment('Estado del tipo. Puede ser Activo, Inactivo');
            $table->integer('idioma_id')->unsigned();

            $table->foreign('idioma_id')
                  ->references('idioma_id')->on('idioma')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_caracter');
    }
}

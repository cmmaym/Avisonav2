<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoLuzTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_luz', function (Blueprint $table) {
            $table->increments('tipo_luz_id')->unsigned();
            $table->string('clase', 100)->comment('Clase de luz');
            $table->string('alias', 45)->comment('Abreviatura de la clase');
            $table->mediumText('descripcion')->comment('Descripcion breve de la clase de luz');
            $table->string('illustracion', 45)->nullable()->comment('Imagen de la clase de luz');
            $table->string('cod_ide', 45)->comment('Codigo que identifica a un grupo de registros que unicamente se diferencian por el lenguaje pero que son iguales');
            $table->timestamps();
            $table->enum('estado', array('A','I'))->default('A')->comment('Estado del tipo luz. Puede ser Activo, Inactivo');
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
        Schema::dropIfExists('tipo_luz');
    }
}

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
            $table->increments('ayuda_id')->unsigned();
            $table->integer('numero')->comment('Numero nacional - Es un numero dependiendo de la situacion geografica');
            $table->string('nombre', 45)->comment('Tipo de la ayuda o luz');
            $table->string('latitud', 100);
            $table->string('longitud', 100);
            $table->timestamps();
            $table->integer('cantidad')->nullable()->comment('Cantidad de ayudas');
            $table->integer('altitud')->nullable()->comment('Altitud de ayuda');
            $table->integer('alcance')->nullable()->comment('Alcance nominal');
            $table->mediumText('descripcion')->nullable()->comment('Descripcion del soporte y la altura');
            $table->mediumText('observacion')->nullable()->comment('Datos complementarios relacionados con la ayuda');
            $table->enum('estado', array('A','I'))->default('A')->comment('Estado de la ayuda. Puede ser Activo, Inactivo');
            $table->integer('version')->comment('Numero de version de la ayuda');
            $table->integer('user_id')->unsigned()->comment('Usuario que creo o actualizo el regitro');
            $table->integer('aviso_id')->unsigned();
            $table->integer('ubicacion_id')->unsigned();
            $table->integer('tipo_luz_id')->unsigned();
            $table->integer('tipo_color_id')->unsigned();
            $table->integer('idioma_id')->unsigned();

            $table->foreign('aviso_id')
                  ->references('aviso_id')->on('aviso')
                  ->onDelete('cascade');
            
            $table->foreign('ubicacion_id')
                  ->references('ubicacion_id')->on('ubicacion')
                  ->onDelete('cascade');

            $table->foreign('tipo_luz_id')
                  ->references('tipo_luz_id')->on('tipo_luz')
                  ->onDelete('cascade');

            $table->foreign('tipo_color_id')
                  ->references('tipo_color_id')->on('tipo_color')
                  ->onDelete('cascade');

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
        Schema::dropIfExists('ayuda');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('number', 100)->comment('Numero del aviso');
            $table->dateTime('date')->comment('Fecha en la que se genero el aviso');
            $table->timestamps();
            $table->string('periodo',45)->comment('Periodo en el que se registro el aviso');
            $table->enum('state',array('A','I'))->default('A')->comment('Estado del aviso. Puede ser Activo, Inactivo');
            $table->longText('file_info')->nullable()->comment('Es la ruta de un archivo con informacion extra que se le puede adjuntar aun aviso. independientemente del caracter del mismo.');
            $table->string('user', 100)->comment('Nombre de usuario que manipulo le registro');
            $table->integer('entity_id')->unsigned();
            $table->integer('character_type_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();

            $table->foreign('entity_id')
                  ->references('id')->on('entity')
                  ->onDelete('cascade');

            $table->foreign('character_type_id')
                  ->references('id')->on('character_type')
                  ->onDelete('cascade');
            
            $table->foreign('parent_id')
                  ->references('id')->on('notice')
                  ->onDelete('cascade');

            $table->unique(['number', 'periodo'], 'number_periodo_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('notice');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

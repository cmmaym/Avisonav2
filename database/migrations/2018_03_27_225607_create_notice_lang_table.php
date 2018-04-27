<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticeLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('observation')->comment('Observacion acerca del aviso');
            $table->timestamps();
            $table->enum('state',array('A','I'))->default('A')->comment('Estado del aviso detalle. Puede ser Activo, Inactivo');
            $table->integer('notice_id')->unsigned();            
            $table->integer('language_id')->unsigned();

            $table->foreign('notice_id')
                ->references('id')->on('notice')
                ->onDelete('cascade');

            $table->foreign('language_id')
                ->references('id')->on('language')
                ->onDelete('cascade');

            $table->unique(['notice_id', 'language_id'], 'notice_language_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notice_lang');
    }
}
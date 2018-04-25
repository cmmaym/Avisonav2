<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAidLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aid_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('description')->comment('Descripcion referente a los cambios en las coordenadas de la ayuda');
            $table->mediumText('observation')->comment('Observacion referente a los cambios en las coordenadas de la ayuda');
            $table->timestamps();
            $table->integer('aid_id')->unsigned();
            $table->integer('coordinate_id')->unsigned();
            $table->integer('language_id')->unsigned();

            $table->foreign('aid_id')
                ->references('id')->on('aid')
                ->onDelete('cascade');
            
            $table->foreign('coordinate_id')
                ->references('id')->on('coordinate')
                ->onDelete('cascade');

            $table->foreign('language_id')
                ->references('id')->on('language')
                ->onDelete('cascade');

            $table->unique(['aid_id', 'language_id'], 'aid_language_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aid_lang');
    }
}

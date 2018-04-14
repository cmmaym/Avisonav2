<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('language', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 45)->comment('Nombre del idioma');
            $table->string('code', 45)->comment('Codigo ISO del idioma');
            $table->timestamps();
            $table->enum('state', array('A','I'))->default('A')->comment('Estado del idioma. Puede ser Activo, Inactivo');

            $table->unique(['name', 'code'], 'name_code_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('language');
    }
}

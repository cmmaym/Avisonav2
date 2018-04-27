<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAidTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aid_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('illustration', 45)->nullable()->comment('Imagen de la clase de luz');
            $table->string('type', 45)->nullable()->comment('Sub tipo que indentifica al tipo de ayuda');
            $table->timestamps();
            $table->enum('state', array('A','I'))->default('A')->comment('Estado del tipo luz. Puede ser Activo, Inactivo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aid_type');
    }
}

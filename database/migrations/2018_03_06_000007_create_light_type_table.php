<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLightTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('light_type', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('illustration', 45)->nullable()->comment('Imagen de la clase de luz');
            $table->string('alias', 45)->comment('Abreviatura de la clase');
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('light_type');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

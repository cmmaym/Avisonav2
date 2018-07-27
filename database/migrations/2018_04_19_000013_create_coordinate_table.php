<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoordinateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coordinate', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('latitud', 100);
            $table->string('longitud', 100);
            $table->timestamps();
            $table->enum('state', array('A','I'))->default('A')->comment('Estado de la coordenada. Puede ser Activo, Inactivo');
            $table->integer('aid_id')->unsigned();

            $table->foreign('aid_id')
                  ->references('id')->on('aid');
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
        Schema::dropIfExists('coordinate');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

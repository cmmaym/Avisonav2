<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 100)->comment('Nombre de la ubicacion de la ayuda');
            $table->string('sub_location_name', 100)->nullable()->comment('Nombre de la sub ubicacion es decir la ubicacion mas espesifica donde se encuentra la ayuda');
            $table->timestamps();
            $table->enum('state', array('A', 'I'))->default('A')->comment('Estado de la ubicacion. Puede ser Activo, Inactivo');
            $table->integer('zone_id')->unsigned();

            $table->foreign('zone_id')
                  ->references('id')->on('zone')
                  ->onDelete('cascade');

            $table->unique(['name', 'zone_id'], 'name_zone_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location');
    }
}
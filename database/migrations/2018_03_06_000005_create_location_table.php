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
            $table->string('created_by', 100);
            $table->string('updated_by', 100);
            $table->integer('zone_id')->unsigned();
            $table->boolean('is_legacy');

            $table->foreign('zone_id')
                  ->references('id')->on('zone');
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
        Schema::dropIfExists('location');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

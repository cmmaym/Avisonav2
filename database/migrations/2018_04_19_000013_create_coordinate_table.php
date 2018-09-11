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
            $table->integer('latitude_degrees');
            $table->integer('latitude_minutes');
            $table->float('latitude_seconds');
            $table->string('latitude_dir', 1);
            $table->integer('longitude_degrees');
            $table->integer('longitude_minutes');
            $table->float('longitude_seconds');
            $table->string('longitude_dir', 1);
            $table->timestamps();
            $table->string('created_by', 100);
            $table->string('updated_by', 100);
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColorLightTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('color_light', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('alias', 45)->comment('Abreviacion del color');
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
        Schema::dropIfExists('color_light');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

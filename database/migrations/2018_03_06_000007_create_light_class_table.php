<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLightClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('light_class', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('alias', 45)->comment('Abreviatura de la clase');
            $table->string('illustration', 45)->nullable()->comment('Imagen de la clase de luz');
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
        Schema::dropIfExists('light_class');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAidTypeFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aid_type_form', function (Blueprint $table) {
            $table->increments('id')->unsigned();
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
        Schema::dropIfExists('aid_type_form');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

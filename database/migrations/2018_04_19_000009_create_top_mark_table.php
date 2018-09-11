<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopMarkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('top_mark', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('illustration', 45)->nullable()->comment('Imagen de la marca de tope');
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
        Schema::dropIfExists('top_mark');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

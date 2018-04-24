<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoveltyTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novelty_type', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->timestamps();            
            $table->enum('state', array('A','I'))->default('A')->comment('Estado del tipo. Puede ser Activo, Inactivo');
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
        Schema::dropIfExists('novelty_type');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

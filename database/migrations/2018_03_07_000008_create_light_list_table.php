<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLightListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('light_list', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('edition')->comment('Numero de edicion de la lista de luces');
            $table->year('year');
            $table->timestamps();

            $table->unique(['edition', 'year'], 'edition_year_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('light_list');
    }
}

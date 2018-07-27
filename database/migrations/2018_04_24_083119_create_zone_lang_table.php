<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZoneLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zone_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->comment('Nombre de la zona de la novedad');
            $table->string('alias', 45)->comment('Alias del nombre de la zona');
            $table->timestamps();
            $table->integer('language_id')->unsigned();
            $table->integer('zone_id')->unsigned();

            $table->foreign('language_id')
                  ->references('id')->on('language');
            
            $table->foreign('zone_id')
                  ->references('id')->on('zone');

            $table->unique(['language_id', 'zone_id'], 'language_zone_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zone_lang');
    }
}

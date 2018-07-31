<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('language', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 45)->comment('Nombre del idioma');
            $table->string('code', 45)->comment('Codigo ISO del idioma');
            $table->timestamps();

            $table->unique(['name', 'code'], 'name_code_UNIQUE');
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
        Schema::dropIfExists('language');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

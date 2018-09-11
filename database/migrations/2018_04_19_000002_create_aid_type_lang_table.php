<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAidTypeLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aid_type_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->comment("Nombre del tipo de ayuda");
            $table->timestamps();
            $table->string('created_by', 100);
            $table->string('updated_by', 100);
            $table->integer('language_id')->unsigned();
            $table->integer('aid_type_id')->unsigned();

            $table->foreign('language_id')
                  ->references('id')->on('language');

            $table->foreign('aid_type_id')
                  ->references('id')->on('aid_type')
                  ->onDelete('cascade');

            $table->unique(['language_id', 'aid_type_id'], 'language_aid_type_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aid_type_lang');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAidTypeFormLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aid_type_form_lang', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('description', 45);
            $table->timestamps();
            $table->string('created_by', 100);
            $table->string('updated_by', 100);
            $table->integer('language_id')->unsigned();
            $table->integer('aid_type_form_id')->unsigned();

            $table->foreign('language_id')
                  ->references('id')->on('language');

            $table->foreign('aid_type_form_id')
                  ->references('id')->on('aid_type_form')
                  ->onDelete('cascade');
            
            $table->unique(['language_id', 'aid_type_form_id'], 'language_aid_type_form_UNIQUE');
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
        Schema::dropIfExists('aid_type_form_lang');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

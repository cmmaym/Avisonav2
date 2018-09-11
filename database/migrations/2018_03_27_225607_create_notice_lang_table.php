<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticeLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('description')->nullable()->comment('Descripcion acerca del aviso');
            $table->timestamps();
            $table->string('created_by', 100);
            $table->string('updated_by', 100);
            $table->integer('notice_id')->unsigned();            
            $table->integer('language_id')->unsigned();

            $table->foreign('notice_id')
                  ->references('id')->on('notice')
                  ->onDelete('cascade');

            $table->foreign('language_id')
                ->references('id')->on('language');

            $table->unique(['notice_id', 'language_id'], 'notice_language_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notice_lang');
    }
}

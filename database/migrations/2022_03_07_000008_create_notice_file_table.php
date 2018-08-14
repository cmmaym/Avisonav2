<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticeFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice_file', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 100)->comment('Nombre del archivo');
            $table->mediumText('path')->comment('Ruta del archivo');
            $table->integer('notice_id')->unsigned();
            $table->timestamps();

            $table->foreign('notice_id')
                ->references('id')->on('notice')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notice_file');
    }
}

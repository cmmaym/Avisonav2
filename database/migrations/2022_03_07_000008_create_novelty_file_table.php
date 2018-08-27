<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoveltyFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novelty_file', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 100)->comment('Nombre del archivo');
            $table->mediumText('path')->comment('Ruta del archivo');
            $table->integer('novelty_id')->unsigned();
            $table->timestamps();

            $table->foreign('novelty_id')
                ->references('id')->on('novelty')
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
        Schema::dropIfExists('novelty_file');
    }
}

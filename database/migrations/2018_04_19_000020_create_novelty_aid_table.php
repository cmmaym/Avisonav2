<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoveltyAidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novelty_aid', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('novelty_id')->unsigned();
            $table->integer('aid_id')->unsigned();
            $table->integer('coordinate_id');
            $table->integer('chart_edition_id');
            $table->timestamps();

            $table->foreign('novelty_id')
                ->references('id')->on('novelty')
                ->onDelete('cascade');

            $table->foreign('aid_id')
                ->references('id')->on('aid')
                ->onDelete('cascade');

            $table->unique(['novelty_id', 'aid_id'], 'novelty_aid_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('novelty_aid');
    }
}

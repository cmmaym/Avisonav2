<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoveltyCoordinateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novelty_coordinate', function (Blueprint $table) {
            $table->integer('novelty_id')->unsigned();
            $table->integer('coordinate_id')->unsigned();
            $table->timestamps();
            $table->string('created_by', 100);
            $table->string('updated_by', 100);

            $table->foreign('novelty_id')
                ->references('id')->on('novelty')
                ->onDelete('cascade');
            
            $table->foreign('coordinate_id')
                ->references('id')->on('coordinate')
                ->onDelete('cascade');

            $table->unique(['novelty_id', 'coordinate_id'], 'novelty_coordinate_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('novelty_coordinate');
    }
}

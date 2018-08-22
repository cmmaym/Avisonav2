<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoveltyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novelty', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('notice_id')->nullable()->unsigned();
            $table->integer('novelty_type_id')->nullable()->unsigned();
            $table->integer('character_type_id')->nullable()->unsigned();
            $table->timestamps();

            $table->foreign('notice_id')
                  ->references('id')->on('notice')
                  ->onDelete('cascade');
                  
            $table->foreign('novelty_type_id')
                  ->references('id')->on('novelty_type');

            $table->foreign('character_type_id')
                  ->references('id')->on('character_type');

            $table->unique(['notice_id', 'character_type_id', 'novelty_type_id'], 'notice_character_type_novelty_type_UNIQUE');
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
        Schema::dropIfExists('novelty');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

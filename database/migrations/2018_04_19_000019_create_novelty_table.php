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
            $table->integer('notice_id')->unsigned();
            $table->integer('novelty_type_id')->unsigned();
            $table->integer('character_type_id')->unsigned();
            $table->string('state', 1)->comment('El estado puede ser A(Activo) y C(Cancelado)');
            $table->timestamps();
            $table->integer('symbol_id')->nullable()->unsigned();
            $table->integer('parent_id')->nullable()->unsigned();

            $table->foreign('notice_id')
                  ->references('id')->on('notice')
                  ->onDelete('cascade');
                  
            $table->foreign('novelty_type_id')
                  ->references('id')->on('novelty_type');

            $table->foreign('character_type_id')
                  ->references('id')->on('character_type');
            
            $table->foreign('symbol_id')
                  ->references('id')->on('symbol');
            
            $table->foreign('parent_id')
                  ->references('id')->on('novelty');
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

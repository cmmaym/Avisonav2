<?php

use Illuminate\Support\Facades\Schema;
// use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Grimzy\LaravelMysqlSpatial\Schema\Blueprint;

class CreateSymbolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('symbol', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->timestamps();
            $table->string('created_by', 100);
            $table->string('updated_by', 100);
            $table->point('position')->nullable();
            $table->integer('symbol_type_id')->unsigned();
            $table->integer('image_id')->unsigned();
            $table->integer('location_id')->unsigned();
            
            $table->foreign('symbol_type_id')
                  ->references('id')->on('symbol_type');
            
            $table->foreign('image_id')
                  ->references('id')->on('image');

            $table->foreign('location_id')
                  ->references('id')->on('location');
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
        Schema::dropIfExists('symbol');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

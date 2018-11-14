<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSymbolTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('symbol_type', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title', 100);
            $table->string('code', 5);
            $table->timestamps();
            $table->string('created_by', 100);
            $table->string('updated_by', 100);

            $table->unique(['code'], 'code_UNIQUE');
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
        Schema::dropIfExists('symbol_type');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

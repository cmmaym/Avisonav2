<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_type', function (Blueprint $table) {
            $table->integer('aid_type_form_id')->unsigned();
            $table->integer('aid_type_id')->unsigned();
            $table->timestamps();

            $table->foreign('aid_type_form_id')
                  ->references('id')->on('aid_type_form');
            
            $table->foreign('aid_type_id')
                  ->references('id')->on('aid_type');
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
        Schema::dropIfExists('form_type');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aid', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('racon', 10)->nullable()->comment("Baliza respondedora de radar");
            $table->string('ais', 100)->nullable()->comment("Sistema de identificacion automatica");
            $table->bool('radar_reflector');
            $table->float('float_diameter');
            $table->timestamps();
            $table->string('created_by', 100);
            $table->string('updated_by', 100);
            $table->string('user', 100)->comment('Nombre de usuario que manipulo le registro');
            $table->integer('light_class_id')->unsigned();
            $table->integer('color_structure_pattern_id')->unsigned();
            $table->integer('top_mark_id')->nullable()->unsigned();
            $table->integer('aid_type_id')->unsigned();
            $table->integer('aid_type_form_id')->unsigned();
            $table->integer('symbol_id')->unsigned();

            $table->foreign('light_class_id')
                  ->references('id')->on('light_class');
            
            $table->foreign('color_structure_pattern_id')
                  ->references('id')->on('color_structure');
                  
            $table->foreign('top_mark_id')
                  ->references('id')->on('top_mark');
            
            $table->foreign('aid_type_form_id')
                  ->references('id')->on('aid_type_form');
            
            $table->foreign('aid_type_id')
                  ->references('id')->on('aid_type');
            
            $table->foreign('symbol_id')
                  ->references('id')->on('symbol')
                  ->onDelete('cascade');

            $table->unique(['symbol_id'], 'symbol_UNIQUE');
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
        Schema::dropIfExists('aid');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

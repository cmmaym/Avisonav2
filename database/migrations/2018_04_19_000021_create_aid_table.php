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
            $table->string('height', 45)->comment("Altura de la estructura de la ayuda");
            $table->string('elevation_nmm', 45)->comment("Elevacion de la luz sobre el nivel del mar");
            $table->string('scope', 45)->comment("Alcance nominal de la luz de la ayuda");
            $table->string('flash_groups', 100)->comment("Grupos de flasheos");
            $table->string('period', 45)->comment("Periodo de la luz");
            $table->mediumText('features')->comment('Caracteristicas de la ayuda');
            $table->timestamps();
            $table->string('user', 100)->comment('Nombre de usuario que manipulo le registro');
            $table->integer('location_id')->unsigned();
            $table->integer('light_class_id')->unsigned();
            $table->integer('color_structure_pattern_id')->unsigned();
            $table->integer('top_mark_id')->nullable()->unsigned();
            $table->integer('aid_type_id')->unsigned();
            $table->integer('aid_type_form_id')->unsigned();
            $table->integer('symbol_id')->unsigned();
            
            $table->foreign('location_id')
                  ->references('id')->on('location');

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

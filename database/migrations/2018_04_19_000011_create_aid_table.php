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
            $table->integer('number')->nullable()->comment('Numero nacional - Es un numero dependiendo de la situacion geografica');
            $table->string('name', 100)->nullable()->comment("Nombre de la ayuda");
            $table->integer('elevation');
            $table->integer('scope');
            $table->mediumText('features')->comment('Caracteristicas de la ayuda');
            $table->mediumText('observation')->comment('Observacion referente a los cambios de la ayuda');
            $table->timestamps();
            $table->string('user', 100)->comment('Nombre de usuario que manipulo le registro');
            $table->integer('aid_type_id')->unsigned();
            $table->integer('location_id')->unsigned();
            $table->integer('light_type_id')->unsigned();
            $table->integer('color_type_id')->unsigned();

            $table->foreign('aid_type_id')
                  ->references('id')->on('aid_type');
            
            $table->foreign('location_id')
                  ->references('id')->on('location');

            $table->foreign('light_type_id')
                ->references('id')->on('light_type');
            
            $table->foreign('color_type_id')
                ->references('id')->on('color_type');

            $table->unique(['number', 'location_id'], 'number_location_UNIQUE');
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

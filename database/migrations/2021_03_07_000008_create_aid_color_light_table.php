<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAidColorLightTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aid_color_light', function (Blueprint $table) {
            $table->integer('aid_id')->unsigned();
            $table->integer('color_light_id')->unsigned();
            $table->integer('angle')->comment('Angulo del sector de la luz');
            $table->timestamps();

            $table->foreign('aid_id')
                ->references('id')->on('aid')
                ->onDelete('cascade');
            
            $table->foreign('color_light_id')
                ->references('id')->on('color_light')
                ->onDelete('cascade');

            $table->unique(['aid_id', 'color_light_id'], 'aid_color_light_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aid_color_light');
    }
}

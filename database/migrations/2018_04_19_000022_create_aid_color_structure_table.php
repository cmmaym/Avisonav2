<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAidColorStructureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aid_color_structure', function (Blueprint $table) {
            $table->integer('aid_id')->unsigned();
            $table->integer('color_structure_id')->unsigned();
            $table->timestamps();
            $table->string('created_by', 100);
            $table->string('updated_by', 100);

            $table->foreign('aid_id')
                ->references('id')->on('aid')
                ->onDelete('cascade');
            
            $table->foreign('color_structure_id')
                ->references('id')->on('color_structure')
                ->onDelete('cascade');

            $table->unique(['aid_id', 'color_structure_id'], 'aid_color_structure_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aid_color_structure');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeightTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('height', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->float('structure_height');
            $table->float('elevation');
            $table->timestamps();
            $table->string('created_by', 100);
            $table->string('updated_by', 100);
            $table->string('state', 1)->comment('El estado puede ser C=Current(Actual) o A:Archived(Archivado)');
            $table->integer('aid_id')->unsigned();

            $table->foreign('aid_id')
                ->references('id')->on('aid')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('height');
    }
}

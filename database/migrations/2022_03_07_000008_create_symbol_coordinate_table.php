<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSymbolCoordinateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('symbol_coordinate', function (Blueprint $table) {
            $table->integer('symbol_id')->unsigned();
            $table->integer('coordinate_id')->unsigned();
            $table->timestamps();
            $table->string('created_by', 100);
            $table->string('updated_by', 100);
            $table->string('state', 1)->comment('El estado puede ser C=Current(Actual) o A:Archived(Archivado)');

            $table->foreign('symbol_id')
                ->references('id')->on('symbol')
                ->onDelete('cascade');
            
            $table->foreign('coordinate_id')
                ->references('id')->on('coordinate')
                ->onDelete('cascade');

            $table->unique(['symbol_id', 'coordinate_id'], 'symbol_coordinate_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('symbol_coordinate');
    }
}

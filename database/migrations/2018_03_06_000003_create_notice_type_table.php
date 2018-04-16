<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticeTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice_type', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 100)->comment('Nombre del tipo de aviso');
            $table->timestamps();            
            $table->enum('state', array('A','I'))->default('A')->comment('Estado del tipo. Puede ser Activo, Inactivo');
            $table->integer('language_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();

            $table->foreign('language_id')
                  ->references('id')->on('language')
                  ->onDelete('cascade');

            $table->foreign('parent_id')
                  ->references('id')->on('notice_type')
                  ->onDelete('cascade');            

            $table->unique(['name', 'language_id'], 'name_language_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notice_type');
    }
}

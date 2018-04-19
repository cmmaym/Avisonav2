<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAidTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aid_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->comment("Nombre del tipo de ayuda");
            $table->string('illustration', 45)->nullable()->comment('Imagen de la clase de luz');
            $table->timestamps();
            $table->enum('state', array('A','I'))->default('A')->comment('Estado del tipo luz. Puede ser Activo, Inactivo');
            $table->integer('language_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();

            $table->foreign('language_id')
                  ->references('id')->on('language')
                  ->onDelete('cascade');

            $table->foreign('parent_id')
                  ->references('id')->on('aid_type')
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
        Schema::dropIfExists('aid_type');
    }
}

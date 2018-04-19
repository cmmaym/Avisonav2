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
            $table->string('sub_name', 100)->nullable()->comment("Nombre que describe mas a la ayuda");
            $table->timestamps();
            $table->enum('state', array('A','I'))->default('A')->comment('Estado de la ayuda. Puede ser Activo, Inactivo');
            $table->string('user', 100)->comment('Nombre de usuario que manipulo le registro');
            $table->integer('aid_type_id')->unsigned();
            $table->integer('location_id')->unsigned();

            $table->foreign('aid_type_id')
                  ->references('id')->on('aid_type')
                  ->onDelete('cascade');
            
            $table->foreign('location_id')
                  ->references('id')->on('location')
                  ->onDelete('cascade');

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
        Schema::dropIfExists('aid');
    }
}

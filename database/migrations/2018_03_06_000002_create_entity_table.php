<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 100)->comment('Nombre de la entidad o usuario que reporto el aviso');
            $table->string('alias', 45)->comment('Alias o nombre corto de la entidad o usuario');
            $table->timestamps();
            $table->enum('state', array('A','I'))->default('A')->comment('Estado de la entidad. Puede ser Activo, Inactivo');

            $table->unique(['name', 'alias'], 'name_alias_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entity');
    }
}

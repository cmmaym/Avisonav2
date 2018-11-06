<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('num_ide');
            $table->string('username', 100);
            $table->string('name1', 100);
            $table->string('name2', 100)->nullable();
            $table->string('last_name1', 100);
            $table->string('last_name2', 100);
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
            $table->string('created_by', 100);
            $table->string('updated_by', 100);
            $table->enum('state', array('A','I'))->default('A')->comment('Estado del usuario. Puede ser Activo, Inactivo');
            $table->integer('role_id')->unsigned();

            $table->foreign('role_id')
                ->references('id')->on('role');

            $table->unique(['username'], 'username_UNIQUE');
            $table->unique(['email'], 'email_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticeAidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice_aid', function (Blueprint $table) {
            $table->integer('notice_id')->unsigned();
            $table->integer('aid_id')->unsigned();
            $table->integer('aid_lang_id');
            $table->timestamps();

            $table->foreign('notice_id')
                ->references('id')->on('notice')
                ->onDelete('cascade');

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
        Schema::dropIfExists('notice_aid');
    }
}

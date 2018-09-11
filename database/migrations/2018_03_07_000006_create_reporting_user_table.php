<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportingUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reporting_user', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 100);
            $table->string('rank', 45);
            $table->timestamps();
            $table->string('created_by', 100);
            $table->string('updated_by', 100);
            $table->integer('report_source_id')->unsigned();

            $table->foreign('report_source_id')
                  ->references('id')->on('report_source');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reporting_user');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportParameterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_parameter', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name_person1', 100)->comment('Nombre del Responsable Avisos a los navegantes');
            $table->mediumText('firm_person1')->comment('Ruta de imagen de la firma Responsable Avisos a los navegantes');
            $table->string('name_person2', 100)->comment('Nombre del Responsable Sección Náutica');
            $table->mediumText('firm_person2')->comment('Ruta de imagen de la firma Responsable Sección Náutica');
            $table->string('name_person2', 100)->comment('Nombre del Responsable Área de Hidrografia');
            $table->mediumText('firm_person2')->comment('Ruta de imagen de la firma Responsable Área de Hidrografia');
            $table->timestamps();
            $table->string('created_by', 100);
            $table->string('updated_by', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_parameter');
    }
}

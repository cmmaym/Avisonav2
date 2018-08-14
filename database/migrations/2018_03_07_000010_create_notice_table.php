<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('number', 100)->comment('Numero del aviso');
            $table->year('year')->comment('Año en el que se registro el aviso');
            $table->mediumText('reports_numbers')->comment('Numeros de los reportes');
            $table->dateTime('report_date')->comment('Fecha en la que se genero el reporte');
            $table->timestamps();
            $table->string('state', 1)->comment('Estado del aviso. Puede ser G(Guardado), P(Publicado)');
            $table->longText('file_info')->nullable()->comment('Es la ruta de un archivo con informacion extra que se le puede adjuntar aun aviso. independientemente del caracter del mismo.');
            $table->string('user', 100)->comment('Nombre de usuario que manipulo le registro');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('character_type_id')->unsigned();
            $table->integer('novelty_type_id')->unsigned();
            $table->integer('location_id')->unsigned();
            $table->integer('catalog_ocean_coast_id')->unsigned()->nullable();
            $table->integer('light_list_id')->unsigned()->nullable();
            $table->integer('report_source_id')->unsigned();
            $table->integer('reporting_user_id')->unsigned();

            $table->foreign('parent_id')
                  ->references('id')->on('notice');

            $table->foreign('character_type_id')
                  ->references('id')->on('character_type');

            $table->foreign('novelty_type_id')
                  ->references('id')->on('novelty_type');
            
            $table->foreign('location_id')
                  ->references('id')->on('location');
            
            $table->foreign('catalog_ocean_coast_id')
                  ->references('id')->on('catalog_ocean_coast');
            
            $table->foreign('light_list_id')
                  ->references('id')->on('light_list');

            $table->foreign('report_source_id')
                  ->references('id')->on('report_source');
            
            $table->foreign('reporting_user_id')
                  ->references('id')->on('reporting_user');

            $table->unique(['number', 'year'], 'number_year_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('notice');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

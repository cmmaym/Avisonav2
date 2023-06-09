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
            $table->string('created_by', 100);
            $table->string('updated_by', 100);
            $table->string('review_user', 100);
            $table->dateTime('review_date');
            $table->string('rh_user', 100);
            $table->dateTime('rh_date_user_confirm');
            $table->string('state', 1)->comment('Estado del aviso. Puede ser G(Guardado), P(Publicado)');
            $table->integer('location_id')->unsigned();
            $table->integer('catalog_ocean_coast_id')->unsigned()->nullable();
            $table->integer('light_list_id')->unsigned()->nullable();
            $table->integer('report_source_id')->unsigned();
            $table->integer('reporting_user_id')->unsigned();
            $table->boolean('is_legacy');
            
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

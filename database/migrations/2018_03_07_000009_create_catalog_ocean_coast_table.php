<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogOceanCoastTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_ocean_coast', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('edition')->comment('Numero de edicion del catalogo');
            $table->year('year');
            $table->timestamps();
            $table->string('created_by', 100);
            $table->string('updated_by', 100);

            $table->unique(['edition', 'year'], 'edition_year_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalog_ocean_coast');
    }
}

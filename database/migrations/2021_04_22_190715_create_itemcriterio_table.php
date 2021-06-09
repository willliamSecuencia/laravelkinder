<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemcriterioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itemcriterio', function (Blueprint $table) {
            $table->bigIncrements('iditemcriterio');
            $table->unsignedBigInteger('criterio_id');
            $table->unsignedBigInteger('nivel_id');
            $table->string('descripcion');
            $table->integer('estado');//para saber si esta activo o inactivo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itemcriterio');
    }
}

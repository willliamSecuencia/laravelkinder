<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactos', function (Blueprint $table) {
            $table->bigIncrements('idcontacto');
            $table->unsignedBigInteger('tipousuario_id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('nit');
            $table->string('direccion');
            $table->string('correoelectronico');
            $table->string('telefono');
            $table->string('celular');
            $table->integer('estado');//para saber si esta activo o inactivo
            $table->mediumText('imagen')->nullable();
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
        Schema::dropIfExists('contactos');
    }
}

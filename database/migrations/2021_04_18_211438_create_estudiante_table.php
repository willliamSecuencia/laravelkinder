<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudianteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiante', function (Blueprint $table) {
            $table->bigIncrements('idestudiante');
            $table->unsignedBigInteger('nivel_id');
            $table->unsignedBigInteger('contacto_id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('fechaNacimiento');
            $table->string('celularpadre')->nullable();
            $table->string('celularmadre')->nullable();
            $table->string('direccion')->nullable();
            $table->mediumText('imagen')->nullable();
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
        Schema::dropIfExists('estudiante');
    }
}

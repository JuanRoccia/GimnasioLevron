<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSociosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socios', function (Blueprint $table) {
            $table->id();
            
            $table->string('tipo_doc');
            $table->string('nro_doc');
            $table->string('apellido');
            $table->string('nombre');
            $table->string('calle');
            $table->string('numero');
            $table->string('piso');
            $table->string('dpto');
            $table->string('codigo_postal');
            $table->string('codigo_area');
            $table->string('telefono');
            $table->string('email');
            $table->string('fecha_ingreso');

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
        Schema::dropIfExists('socios');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuotas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('socio_id');
            $table->decimal('monto', 8, 2);
            $table->date('fecha_pago');
            $table->string('metodo_pago');
            $table->boolean('activa')->default(true);
            $table->timestamps();

            $table->foreign('socio_id')->references('id')->on('socios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuotas');
    }
}

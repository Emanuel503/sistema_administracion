<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transportes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_dependencia')->constrained('dependencias_transportes', 'id');
            $table->foreignId('id_conductor')->constrained('users', 'id');
            $table->foreignId('id_placa')->constrained('vehiculos', 'id');
            $table->date('fecha');
            //Salida
            $table->time('hora_salida');
            $table->string('km_salida');
            $table->foreignId('lugar_salida')->constrained('lugares', 'id');
            //Destino
            $table->time('hora_destino');
            $table->string('km_destino');
            $table->foreignId('lugar_destino')->constrained('lugares', 'id');
            //Otros
            $table->string('distancia_recorrida');
            $table->string('combustible');
            $table->string('tipo_combustible');
            $table->foreignId('pasajero')->constrained('users', 'id');
            $table->string('objetivo');
            $table->string('correlativo');
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
        Schema::dropIfExists('transportes');
    }
};

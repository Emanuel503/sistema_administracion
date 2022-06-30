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
        Schema::create('solicitud_combustibles', function (Blueprint $table) {
            $table->id();
            //Datos solicitud
            $table->foreignId('id_destinatario')->constrained('users', 'id');
            $table->foreignId('id_origen')->constrained('users', 'id');
            $table->date('fecha_solicitud');
            //Detalle
            $table->foreignId('id_vehiculo')->constrained('vehiculos', 'id');
            $table->foreignId('id_conductor')->constrained('users', 'id');
            $table->foreignId('lugar_destino')->constrained('lugares', 'id');
            $table->date('fecha_detalle');
            $table->time('hora_salida');
            $table->string('objetivo');
            $table->string('tipo_combustible');
            $table->string('cantidad_combustible');
            $table->string('kilometraje');
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
        Schema::dropIfExists('solicitud_combustibles');
    }
};

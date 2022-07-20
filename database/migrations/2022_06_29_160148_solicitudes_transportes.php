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
        Schema::create('solicitudes_transportes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_dependencia')->constrained('dependencias', 'id');
            $table->foreignId('id_lugar')->constrained('lugares', 'id');
            $table->foreignId('id_usuario')->constrained('users', 'id');
            $table->foreignId('id_motorista')->nullable()->constrained('users', 'id');
            $table->foreignId('id_vehiculo')->nullable()->constrained('vehiculos', 'id');
            $table->foreignId('id_autorizacion')->constrained('autorizaciones', 'id');
            $table->date('fecha');
            $table->time('hora_salida');
            $table->time('hora_regreso');
            $table->string('objetivo');
            $table->string('observaciones');
            $table->string('lugar_solicitud');
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
        Schema::dropIfExists('solicitudes_transportes');
    }
};

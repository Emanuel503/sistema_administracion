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
            $table->foreignId('id_dependencia')->constrained('dependencias_transportes', 'id');
            $table->foreignId('id_lugar')->constrained('lugares', 'id');
            $table->foreignId('id_usuario')->constrained('users', 'id');
            $table->foreignId('id_autorizacion')->constrained('autorizaciones', 'id');
            $table->string('fecha');
            $table->string('hora_salida');
            $table->string('hora_regreso');
            $table->string('objetivo');
            $table->string('observaciones');
            $table->string('fecha_solicitud');
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

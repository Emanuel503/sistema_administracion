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
        Schema::create('solicitudes_salas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_autorizacion')->constrained('autorizaciones', 'id');
            $table->foreignId('id_usuario')->constrained('users', 'id');
            $table->foreignId('id_sala')->constrained('salas', 'id');
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_finalizacion');
            $table->string('actividad');
            $table->string('observaciones');
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
        Schema::dropIfExists('solicitudes_salas');
    }
};

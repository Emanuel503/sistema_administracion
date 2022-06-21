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
        Schema::create('actividades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_organizador')->constrained('lugares', 'id');
            $table->foreignId('id_lugar')->constrained('lugares', 'id');
            $table->foreignId('id_coordinador')->constrained('users', 'id');
            $table->string('nombre_actividad');
            $table->date('fecha_inicio');
            $table->date('fecha_finalizacion');
            $table->time('hora_inicio');
            $table->time('hora_finalizacion');
            $table->string('objetivo');
            $table->string('observaciones');
            $table->string('estado');
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
        Schema::dropIfExists('actividades');
    }
};

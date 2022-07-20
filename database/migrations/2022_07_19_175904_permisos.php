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
        Schema::create('permisos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('users', 'id');
            $table->foreignId('id_dependencia')->constrained('dependencias', 'id');
            $table->foreignId('id_licencia')->constrained('tipos_permisos', 'id');
            $table->foreignId('id_motivo')->constrained('motivos_permisos', 'id');
            $table->foreignId('id_usuario_autoriza')->constrained('users', 'id');
            $table->foreignId('id_estado')->constrained('estados_permisos', 'id');
            $table->foreignId('id_usuario_adiciono')->constrained('users', 'id');
            $table->date('fecha_entrada');
            $table->time('hora_entrada');
            $table->date('fecha_salida');
            $table->time('hora_salida');
            $table->date('fecha_permiso');
            $table->string('tiempo_dia');
            $table->string('tiempo_horas');
            $table->string('tiempo_minutos');
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
        Schema::dropIfExists('permisos');
    }
};

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
        Schema::create('registros_salidas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_lugar')->constrained('lugares', 'id');
            $table->foreignId('id_usuario')->constrained('users', 'id');
            $table->foreignId('id_estado')->constrained('estados_salidas', 'id');
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_final');
            $table->string('objetivo');
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
        Schema::dropIfExists('registros_salidas');
    }
};

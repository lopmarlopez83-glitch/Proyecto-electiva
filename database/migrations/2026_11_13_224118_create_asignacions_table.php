<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asignaciones', function (Blueprint $table) {
            $table->id();

            $table->foreignId('solicitud_id')
                  ->constrained('solicitudes')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreignId('equipo_id')
                  ->constrained('equipos')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->string('estado')->default('asignado'); // asignado | devuelto

            $table->timestamp('asignado_en')->useCurrent();
            $table->timestamp('devuelta_en')->nullable();

            $table->timestamps();

            $table->unique(['solicitud_id', 'equipo_id']);
            $table->index('estado');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asignaciones');
    }
};
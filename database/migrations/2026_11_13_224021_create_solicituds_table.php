<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->foreignId('categoria_id')
                  ->constrained('categorias')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->foreignId('oficina_id')
                  ->constrained('oficinas')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->integer('cantidad');

            $table->string('tipo_prestamo'); // asignacion | prestamo
            $table->timestamp('fecha_devolucion')->nullable();

            $table->string('estado')->default('pendiente'); // pendiente | aprobada | rechazada | devuelta

            $table->text('motivo_rechazo')->nullable();

            $table->foreignId('aprobada_por')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null')
                  ->onUpdate('cascade');

            $table->timestamp('aprobada_en')->nullable();

            $table->timestamps();

            $table->index('estado');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};
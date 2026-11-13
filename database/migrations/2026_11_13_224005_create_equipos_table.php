<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->string('serial')->unique();

            $table->foreignId('modelo_id')
                  ->constrained('modelos')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->string('cpu')->nullable();
            $table->string('ram')->nullable();
            $table->string('almacenamiento')->nullable();

            $table->string('estado')->default('disponible');

            $table->timestamps();
            $table->softDeletes();

            $table->index('estado');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
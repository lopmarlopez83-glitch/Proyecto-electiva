<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('modelos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');

            $table->foreignId('marca_id')
                  ->constrained('marcas')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->foreignId('categoria_id')
                  ->constrained('categorias')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->timestamps();

            $table->unique(['nombre', 'marca_id', 'categoria_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modelos');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->id();

            $table->string('titulo');
            $table->string('autor');

            $table->string('isbn')->unique();

            $table->text('descripcion')->nullable();

            $table->string('genero')->nullable();

            $table->string('idioma')->nullable();

            $table->integer('anio_publicacion')->nullable();

            $table->string('portada')->nullable();

            $table->enum('clasificacion_edad', [
                'infantil',
                'juvenil',
                'adulto'
            ]);

            $table->integer('max_prestamos')->default(3);

            $table->foreignId('categoria_id')
                ->constrained('categorias')
                ->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libros');
    }
};

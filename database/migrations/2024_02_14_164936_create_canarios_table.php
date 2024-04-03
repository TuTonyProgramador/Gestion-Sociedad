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
        Schema::create('canarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombreRaza')->nullable(false);
            $table->integer('anioNacimiento')->nullable(false);
            $table->string('sexo')->nullable(false);
            $table->integer('numeroAnilla')->nullable(false);
            $table->string('descripcion')->nullable(false);
            $table->string('vaConcurso')->nullable(true);
            $table->unsignedBigInteger('criador_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canarios');
    }
};

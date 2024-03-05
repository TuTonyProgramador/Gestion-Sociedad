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
        Schema::create('criadors', function (Blueprint $table) {
            $table->id();
            $table->string('numeroCriador')->unique()->nullable(false);
            $table->string('nombre')->nullable(false);
            $table->string('apellidos')->nullable(false);
            $table->date('fechaNacimiento')->nullable(false);
            $table->string('localidad')->nullable(false);
            $table->string('password')->nullable(false);
            $table->string('email')->nullable(false);
            $table->unsignedBigInteger('telefono')->nullable(false);
            $table->boolean('esAdmin')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criadors');
    }
};

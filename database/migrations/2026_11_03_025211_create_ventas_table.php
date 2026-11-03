<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->foreignId('videojuego_id')->constrained('videojuegos');
            $table->integer('cantidad')->default(1);
            $table->decimal('total', 10, 2);
            $table->date('fecha_venta');
            $table->enum('estado', ['completada', 'cancelada'])->default('completada');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('ventas');
    }
};
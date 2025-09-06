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
        Schema::create('portas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('qa_id')->constrained('quartos')->cascadeOnDelete();
            $table->foreignId('qb_id')->constrained('quartos')->cascadeOnDelete();
            $table->integer('qax');
            $table->integer('qay');
            $table->integer('qbx');
            $table->integer('qby');
            $table->foreignId('mapa_id')->constrained('mapas')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portas');
    }
};

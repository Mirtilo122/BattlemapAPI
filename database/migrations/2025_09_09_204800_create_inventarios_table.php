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
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('itens')->onDelete('cascade');
            $table->foreignId('personagem_id')->constrained('personagens')->onDelete('cascade');
            $table->integer('quantidade')->default(1);
            $table->foreignId('local_id')->nullable()->constrained('locais_jogadores')->nullOnDelete();
            $table->string('caminho')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventarios');
    }
};

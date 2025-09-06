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
        Schema::create('monstros', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->integer('deslocamento_base');
            $table->string('imagem_perfil')->nullable();
            $table->string('imagem_token');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monstros');
    }
};

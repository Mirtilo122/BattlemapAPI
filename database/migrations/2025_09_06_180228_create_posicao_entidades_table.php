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
        Schema::create('posicao_entidades', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_entidade'); // 'jogador' ou 'monstro'
            $table->unsignedBigInteger('entidade_id'); // id do jogador ou monstro
            $table->unsignedBigInteger('mapa_id');
            $table->unsignedBigInteger('quarto_id')->nullable();
            $table->integer('x');
            $table->integer('y');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posicao_entidades');
    }
};

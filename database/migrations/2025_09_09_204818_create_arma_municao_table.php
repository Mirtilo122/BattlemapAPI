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
        Schema::create('arma_municao', function (Blueprint $table) {
            $table->id();
            $table->foreignId('arma_id')->constrained('itens_armas')->onDelete('cascade');
            $table->foreignId('municao_id')->constrained('itens')->onDelete('cascade');
            $table->integer('atual')->default(0);
            $table->integer('maximo')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arma_municao');
    }
};

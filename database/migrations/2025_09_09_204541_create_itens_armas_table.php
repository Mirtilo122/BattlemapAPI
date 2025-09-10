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
       Schema::create('itens_armas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('itens')->onDelete('cascade');
            $table->string('dano_base');
            $table->string('margem_critico_base')->default('20');
            $table->string('multiplicador_critico_base')->default('x2');
            $table->string('arma_base')->nullable();
            $table->boolean('municao')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itens_armas');
    }
};

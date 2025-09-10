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
        Schema::create('itens', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->text('habilidade')->nullable();
            $table->string('imagem')->nullable();

            $table->foreignId('tipo_item_id')->constrained('tipos_itens')->onDelete('cascade');
            $table->foreignId('subtipo_id')->nullable()->constrained('subtipos')->nullOnDelete();

            $table->enum('originalidade', ['Unico', 'Generico'])->default('Generico');

            $table->boolean('guia')->default(true);
            $table->integer('raridade')->default(1);
            $table->enum('categoria', ['I','II','III','IV','V','VI','VII','VIII','IX','X']);
            $table->string('elemento')->default('Nenhum');
            $table->integer('espaco')->default(1);
            $table->decimal('valor', 12, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itens');
    }
};

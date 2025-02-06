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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Colunas da tabela
            $table->string('nome');
            $table->decimal('preco', 8, 2); // Preço com 8 dígitos no total e 2 casas decimais
            $table->text('descricao')->nullable(); // Descrição pode ser nula

            // Timestamps (created_at e updated_at)
            $table->timestamps();

            // Soft Deletes (deleted_at)
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

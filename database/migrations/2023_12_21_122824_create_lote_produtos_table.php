<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lote_produtos', static function (Blueprint $table) {
            $table->id();
            $table->string('numero_lote')->unique('lote_produtos_numero_lote_unique')
                ->nullable(false);
            $table->double('preco_custo', 8, 2)->nullable(false);
            $table->date('data_validade')->nullable(true);
            $table->foreignId('fornecedor_id')->constrained('fornecedor_produtos');
            $table->boolean('lote_finalizado')->default(false);
            $table->boolean('lote_vencido')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lote_produtos');
    }
};

<?php

use App\Enums\UnidadeMedidaMassaVolume;
use App\Enums\UnidadeMedidaQuantidade;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_produto')->unique('produtos_codigo_produto_unique')
                ->nullable(false);
            $table->string('nome_produto', 50)->unique('produtos_nome_produto_unique')
                ->nullable(false);
            $table->text('descricao_produto')->nullable(true);
            $table->enum('unidade_medida', array_merge(UnidadeMedidaMassaVolume::getConstants(), UnidadeMedidaQuantidade::getConstants()))->nullable(false);
            $table->json('informacoes_nutricionais')->nullable(false);
            $table->foreignId('categoria_id')->constrained('categoria_produtos');
            $table->foreignId('marca_id')->constrained('marca_produtos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};

<?php

use App\Enums\UnidadeMedidaMassa;
use App\Enums\UnidadeMedidaVolume;
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
        Schema::create('produtos', static function (Blueprint $table) {
            $table->id();
            $table->string('codigo_produto')->unique('produtos_codigo_produto_unique')
                ->nullable(false);
            $table->string('nome_produto', 50)->unique('produtos_nome_produto_unique')
                ->nullable(false);
            $table->text('descricao_produto')->nullable(true);
            $table->enum('unidade_medida', array_merge(UnidadeMedidaMassa::getConstants() ,UnidadeMedidaVolume::getConstants(), UnidadeMedidaQuantidade::getConstants()))->nullable(false);
            $table->json('informacoes_nutricionais')->nullable(false);
            $table->foreignId('categoria_id')->constrained('categoria_produtos');
            $table->foreignId('marca_id')->constrained('marca_produtos');
            $table->string('caminho_imagem')->nullable(false);
            $table->timestamps();
            $table->renameColumn('created_at', 'data_cadastro');
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

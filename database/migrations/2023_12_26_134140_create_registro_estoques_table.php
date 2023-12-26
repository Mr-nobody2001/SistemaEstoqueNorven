<?php

use App\Enums\TipoTransacao;
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
        Schema::create('registro_estoques', static function (Blueprint $table) {
            $table->id();
            $table->enum('tipo_transacao' ,TipoTransacao::getConstants())->nullable(false);
            $table->integer('quantidade_transacao')->nullable(false);
            $table->double('preco_venda', 8, 2)->nullable(false);
            $table->foreignId('lote_id')->constrained('lote_produtos');
            $table->foreignId('produto_id')->constrained('produtos');
            $table->timestamps();
            $table->renameColumn('created_at', 'data_registro');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_estoques');
    }
};

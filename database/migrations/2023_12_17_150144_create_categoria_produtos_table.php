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
        Schema::create('categoria_produtos', static function (Blueprint $table) {
            $table->id();
            $table->string('nome_categoria', 50)->unique('categoria_produtos_nome_categoria_unique')
                ->nullable(false);
            $table->text('descricao_categoria')->nullable(true);
            $table->string('caminho_imagem')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoria_produtos');
    }
};

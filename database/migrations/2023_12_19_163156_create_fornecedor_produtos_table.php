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
        Schema::create('fornecedor_produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome_fornecedor', 50)->unique('fornecedor_produtos_nome_fornecedor_unique')
                ->nullable(false);
            $table->string('email', 50)->unique('fornecedor_produtos_email_unique')
                ->nullable(false);
            $table->string('telefone', 11)->unique('fornecedor_produtos_telefone_unique')
                ->nullable(false);
            $table->string('cnpj', 14)->unique('fornecedor_produtos_cnpj_unique')
                ->nullable(true);
            $table->string('cpf', 11)->unique('fornecedor_produtos_cpf_unique')
                ->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fornecedor_produtos');
    }
};

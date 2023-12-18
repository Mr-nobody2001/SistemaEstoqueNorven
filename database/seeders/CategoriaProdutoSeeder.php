<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categoria_produtos')->insert([
            'nome_categoria' => 'Bebidas',
            'descricao_categoria' => 'Refresque-se com as melhores opções de bebidas do mercado.',
            'caminho_imagem' => 'caminho/para/bebidas.jpg',
        ]);

        DB::table('categoria_produtos')->insert([
            'nome_categoria' => 'Doces e Sobremesas',
            'descricao_categoria' => 'Satisfaça sua doçura com as melhores marcas de doces e sobremesas.',
            'caminho_imagem' => 'caminho/para/doces_sobremesas.jpg',
        ]);

        DB::table('categoria_produtos')->insert([
            'nome_categoria' => 'Cereais e Café da Manhã',
            'descricao_categoria' => 'Comece o dia com energia, escolhendo entre os melhores cereais e cafés.',
            'caminho_imagem' => 'caminho/para/cereais_cafe_manha.jpg',
        ]);

        DB::table('categoria_produtos')->insert([
            'nome_categoria' => 'Snacks e Petiscos',
            'descricao_categoria' => 'Aperitivos irresistíveis para qualquer momento do dia.',
            'caminho_imagem' => 'caminho/para/snacks_petiscos.jpg',
        ]);

        DB::table('categoria_produtos')->insert([
            'nome_categoria' => 'Produtos de Limpeza',
            'descricao_categoria' => 'Mantenha sua casa limpa e organizada com as melhores marcas de produtos de limpeza.',
            'caminho_imagem' => 'caminho/para/limpeza.jpg',
        ]);
    }
}

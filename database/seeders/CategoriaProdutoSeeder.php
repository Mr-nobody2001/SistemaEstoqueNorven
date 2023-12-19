<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoriaProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Storage::disk('public')->put('imagens/bebidas.jpg',
            file_get_contents('/home/gabriel/Imagens/bebidas.jpg'));

        Storage::disk('public')->put('imagens/cereais.jpg',
            file_get_contents('/home/gabriel/Imagens/cereais.jpg'));

        Storage::disk('public')->put('imagens/laticinios.jpg',
            file_get_contents('/home/gabriel/Imagens/laticinios.jpg'));

        Storage::disk('public')->put('imagens/confeitaria.jpg',
            file_get_contents('/home/gabriel/Imagens/confeitaria.jpg'));

        Storage::disk('public')->put('imagens/higiene_limpeza.jpg',
            file_get_contents('/home/gabriel/Imagens/higiene_limpeza.jpg'));

        Storage::disk('public')->put('imagens/alimentos_processados.jpg',
            file_get_contents('/home/gabriel/Imagens/alimentos_processados.jpg'));

        DB::table('categoria_produtos')->insert([
            'nome_categoria' => 'Bebidas',
            'descricao_categoria' => 'Categoria que engloba uma variedade de bebidas refrescantes e energéticas.',
            'caminho_imagem' => 'imagens/bebidas.jpg',
        ]);

        DB::table('categoria_produtos')->insert([
            'nome_categoria' => 'Cereais',
            'descricao_categoria' => 'Categoria dedicada a cereais e alimentos matinais nutritivos e saborosos.',
            'caminho_imagem' => 'imagens/cereais.jpg',
        ]);

        DB::table('categoria_produtos')->insert([
            'nome_categoria' => 'Laticínios',
            'descricao_categoria' => 'Categoria que inclui produtos lácteos frescos, como leite, queijo e iogurte.',
            'caminho_imagem' => 'imagens/laticinios.jpg',
        ]);

        DB::table('categoria_produtos')->insert([
            'nome_categoria' => 'Confeitaria',
            'descricao_categoria' => 'Categoria que abrange produtos de confeitaria, como doces, bolos e chocolates.',
            'caminho_imagem' => 'imagens/confeitaria.jpg',
        ]);

        DB::table('categoria_produtos')->insert([
            'nome_categoria' => 'Higiene e Limpeza',
            'descricao_categoria' => 'Categoria destinada a produtos para manter a higiene pessoal e limpeza doméstica.',
            'caminho_imagem' => 'imagens/higiene_limpeza.jpg',
        ]);

        DB::table('categoria_produtos')->insert([
            'nome_categoria' => 'Alimentos Processados',
            'descricao_categoria' => 'Categoria que inclui alimentos processados e prontos para consumo.',
            'caminho_imagem' => 'imagens/alimentos_processados.jpg',
        ]);

    }
}

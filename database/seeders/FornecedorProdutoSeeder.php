<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FornecedorProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fornecedor_produtos')->insert([
            'nome_fornecedor' => 'Bebidas Express',
            'email' => 'bebidasexpress@example.com',
            'telefone' => '(11) 91234-5678',
            'cnpj' => '12.345.678/0001-90',
        ]);

        DB::table('fornecedor_produtos')->insert([
            'nome_fornecedor' => 'Cereais Saudáveis',
            'email' => 'cereaissaudaveis@example.com',
            'telefone' => '(21) 92345-6789',
            'cpf' => '234.567.890-12',
        ]);

        DB::table('fornecedor_produtos')->insert([
            'nome_fornecedor' => 'Leite Puro',
            'email' => 'leitepuro@example.com',
            'telefone' => '(31) 93456-7890',
            'cpf' => '345.678.901-23',
        ]);

        DB::table('fornecedor_produtos')->insert([
            'nome_fornecedor' => 'Doces Gourmet',
            'email' => 'docesgourmet@example.com',
            'telefone' => '(41) 94567-8901',
            'cnpj' => '45.678.901/0001-93',
        ]);

        DB::table('fornecedor_produtos')->insert([
            'nome_fornecedor' => 'Higiene Total',
            'email' => 'higienetotal@example.com',
            'telefone' => '(51) 95678-9012',
            'cnpj' => '56.789.012/0001-94',
        ]);

        DB::table('fornecedor_produtos')->insert([
            'nome_fornecedor' => 'Prontos para Saborear',
            'email' => 'prontosparasaborear@example.com',
            'telefone' => '(61) 96789-0123',
            'cnpj' => '67.890.123/0001-95',
        ]);
    }
}

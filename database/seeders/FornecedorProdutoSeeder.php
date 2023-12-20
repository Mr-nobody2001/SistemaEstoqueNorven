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
            'telefone' => '11912345678',
            'cnpj' => '12345678000190',
            'cpf' => '12345678901',
        ]);

        DB::table('fornecedor_produtos')->insert([
            'nome_fornecedor' => 'Cereais Saudáveis',
            'email' => 'cereaissaudaveis@example.com',
            'telefone' => '21923456789',
            'cpf' => '23456789012',
        ]);

        DB::table('fornecedor_produtos')->insert([
            'nome_fornecedor' => 'Leite Puro',
            'email' => 'leitepuro@example.com',
            'telefone' => '31934567890',
            'cpf' => '34567890123',
        ]);

        DB::table('fornecedor_produtos')->insert([
            'nome_fornecedor' => 'Doces Gourmet',
            'email' => 'docesgourmet@example.com',
            'telefone' => '41945678901',
            'cnpj' => '45678901000193',
        ]);

        DB::table('fornecedor_produtos')->insert([
            'nome_fornecedor' => 'Higiene Total',
            'email' => 'higienetotal@example.com',
            'telefone' => '51956789012',
            'cnpj' => '56789012000194',
        ]);

        DB::table('fornecedor_produtos')->insert([
            'nome_fornecedor' => 'Prontos para Saborear',
            'email' => 'prontosparasaborear@example.com',
            'telefone' => '61967890123',
            'cnpj' => '67890123000195',
        ]);

    }
}

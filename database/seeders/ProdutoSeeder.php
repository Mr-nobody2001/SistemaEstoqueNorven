<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JsonException;
use Random\RandomException;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws JsonException
     * @throws RandomException
     */
    public function run(): void
    {
        $nomesDosProdutos = [
            'Chocoblast Delight',
            'Fizz Fusion Elixir',
            'Crispy Morning Bliss',
            'SilkTouch Harmony Soap',
            'BlastBerry Sparkle',
            'Hazelnut Symphony Delight',
            'Velvet Dream Yogurt',
            'Golden Sunrise Oatmeal',
            'Tomato Tango Ketchup',
        ];

        $descricoesProdutos = [
            'Uma explosão de chocolate que derrete na boca, proporcionando uma experiência celestial.',
            'Uma mistura efervescente que desperta os sentidos, com sabores exóticos e uma explosão de frescor.',
            'Cereal crocante e delicioso que transforma suas manhãs em momentos de puro prazer.',
            'Um sabonete luxuoso que proporciona uma sensação suave como seda e deixa a pele radiante.',
            'Uma bebida refrescante com uma explosão de sabores de frutas silvestres, deixando um rastro de energia.',
            'Um creme de avelã que envolve o paladar em uma sinfonia de sabores ricos e aveludados.',
            'Iogurte cremoso e indulgente que leva você a uma jornada de prazer gustativo.',
            'Aveia dourada que proporciona um café da manhã nutritivo e reconfortante.',
            'Um ketchup vibrante e saboroso que adiciona um toque especial a qualquer refeição.',
        ];

        $unidadesProdutos = [
            'g',
            'mL',
            'g',
            'unidade',
            'mL',
            'g',
            'g',
            'g',
            'mL',
        ];

        $categoriaProdutos = [
            6,
            1,
            2,
            5,
            1,
            4,
            3,
            2,
            6,
        ];

        $alergenosProdutos = [
            ['leite' => 'leite', 'soja' => 'soja'],
            [],
            ['nozes' => 'nozes'],
            [],
            [],
            ['leite' => 'leite'],
            ['leite' => 'leite'],
            [],
            [],
        ];

        for ($i = 0; $i < 9; $i++) {
            DB::table('produtos')->insert([
                'codigo_produto' => '789000000000' . $i,
                'nome_produto' => $nomesDosProdutos[$i],
                'descricao_produto' => $descricoesProdutos[$i],
                'unidade_medida' => $unidadesProdutos[$i],
                'informacoes_nutricionais' => json_encode([
                    'quantidade_porcao' => random_int(1, 99) / 10,
                    'unidade_medida_porcao' => 'mL',
                    'quantidade_energia' => random_int(1, 99) / 10,
                    'unidade_medida_energia' => 'kcal',
                    'quantidade_proteina' => random_int(1, 99) / 10,
                    'unidade_medida_proteina' => 'g',
                    'quantidade_gordura' => random_int(1, 99) / 10,
                    'unidade_medida_gordura' => 'g',
                    'quantidade_acucar' => random_int(1, 99) / 10,
                    'unidade_medida_acucar' => 'g',
                    'quantidade_sodio' => random_int(1, 99) / 10,
                    'unidade_medida_sodio' => 'mg',
                    'alergenos' => $alergenosProdutos[$i],
                ], JSON_THROW_ON_ERROR),
                'categoria_id' => $categoriaProdutos[$i],
                'marca_id' => $i + 1,
                'data_cadastro' => now(),
            ]);
        }
    }
}

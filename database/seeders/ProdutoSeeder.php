<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
        Storage::disk('public')->put('imagens/produto/chocoblast_delight.jpg',
            file_get_contents('/home/gabriel/Imagens/chocoblast_delight.jpg'));

        Storage::disk('public')->put('imagens/produto/fizz_fusion_elixir.jpg',
            file_get_contents('/home/gabriel/Imagens/fizz_fusion_elixir.jpg'));

        Storage::disk('public')->put('imagens/produto/crispy_morning_bliss.jpg',
            file_get_contents('/home/gabriel/Imagens/crispy_morning_bliss.jpg'));

        Storage::disk('public')->put('imagens/produto/silkTouch_harmony_soap.jpg',
            file_get_contents('/home/gabriel/Imagens/silkTouch_harmony_soap.jpg'));

        Storage::disk('public')->put('imagens/produto/blastberry_sparkle.jpg',
            file_get_contents('/home/gabriel/Imagens/blastberry_sparkle.jpg'));

        Storage::disk('public')->put('imagens/produto/hazelnut_symphony_delight.jpeg',
            file_get_contents('/home/gabriel/Imagens/hazelnut_symphony_delight.jpeg'));

        Storage::disk('public')->put('imagens/produto/velvet_dream_yogurt.jpg',
            file_get_contents('/home/gabriel/Imagens/velvet_dream_yogurt.jpg'));

         Storage::disk('public')->put('imagens/produto/golden_sunrise_oatmeal.jpg',
             file_get_contents('/home/gabriel/Imagens/golden_sunrise_oatmeal.jpg'));

          Storage::disk('public')->put('imagens/produto/tomato_tango_ketchup.jpg',
              file_get_contents('/home/gabriel/Imagens/tomato_tango_ketchup.jpg'));

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

        $imagensProduto = [
            'imagens/produto/chocoblast_delight.jpg',
            'imagens/produto/fizz_fusion_elixir.jpg',
            'imagens/produto/crispy_morning_bliss.jpg',
            'imagens/produto/silkTouch_harmony_soap.jpg',
            'imagens/produto/blastberry_sparkle.jpg',
            'imagens/produto/hazelnut_symphony_delight.jpeg',
            'imagens/produto/velvet_dream_yogurt.jpg',
            'imagens/produto/golden_sunrise_oatmeal.jpg',
            'imagens/produto/tomato_tango_ketchup.jpg',
        ];

        for ($i = 0; $i < 9; $i++) {
            DB::table('produtos')->insert([
                'codigo_produto' => '789000000000' . $i,
                'nome_produto' => $nomesDosProdutos[$i],
                'descricao_produto' => $descricoesProdutos[$i],
                'unidade_medida' => $unidadesProdutos[$i],
                'caminho_imagem' => $imagensProduto[$i],
                'informacoes_nutricionais' => json_encode([
                    'quantidade_porcao' => random_int(1, 99) / 10,
                    'unidade_medida_porcao' => 'g',
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

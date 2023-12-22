<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Random\RandomException;

class LoteProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            try {
                DB::table('lote_produtos')->insert([
                    'numero_lote' => 'CM91384811' . (random_int(10, 99)),
                    'data_validade' => now()->addMonths(random_int(1, 12))->addDays(random_int(1, 31))->format('Y-m-d'),
                    'preco_custo' => number_format(random_int(10, 29) + (random_int(0, 99) / 100), 2, '.', ''),
                    'preco_venda' => number_format(random_int(30, 99) + (random_int(0, 99) / 100), 2, '.', ''),
                    'fornecedor_id' => random_int(1, 5)
                ]);
            } catch (RandomException $e) {
                Log::error('Ocorreu um erro durante a execução da seeder: ' . $e->getMessage());
            }
        }
    }
}

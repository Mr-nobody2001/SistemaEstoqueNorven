<?php

namespace Database\Seeders;

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
                    'numero_lote' => 'CM91384811' . $i,
                    'data_validade' => now()->addMonths(random_int(1, 12))->addDays(random_int(1, 31))->format('Y-m-d'),
                    'fornecedor_id' => random_int(1, 5)
                ]);
            } catch (RandomException $e) {
                Log::error('Ocorreu um erro durante a execução da seeder: ' . $e->getMessage());
            }
        }
    }
}

<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcaProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('marca_produtos')->insert([
            'nome_marca' => 'Nestlé',
        ]);

        DB::table('marca_produtos')->insert([
            'nome_marca' => 'Coca-Cola',
        ]);

        DB::table('marca_produtos')->insert([
            'nome_marca' => 'Kellogg\'s',
        ]);

        DB::table('marca_produtos')->insert([
            'nome_marca' => 'Unilever',
        ]);

        DB::table('marca_produtos')->insert([
            'nome_marca' => 'Pepsi',
        ]);

        // Adicione mais 10 marcas aqui
        DB::table('marca_produtos')->insert([
            'nome_marca' => 'Ferrero',
        ]);

        DB::table('marca_produtos')->insert([
            'nome_marca' => 'Danone',
        ]);

        DB::table('marca_produtos')->insert([
            'nome_marca' => 'Quaker Oats',
        ]);

        DB::table('marca_produtos')->insert([
            'nome_marca' => 'Kraft Heinz',
        ]);
    }
}

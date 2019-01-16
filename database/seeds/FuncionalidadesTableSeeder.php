<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FuncionalidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('funcionalidades')->insert([
            'id' => 1,
            'nome' => 'Usuários',
            'status' => 'A',
        ]);

        DB::table('funcionalidades')->insert([
            'id' => 2,
            'nome' => 'Fornecedor',
            'status' => 'A',
        ]);

        DB::table('funcionalidades')->insert([
            'id' => 3,
            'nome' => 'Ordem de Compra',
            'status' => 'A',
        ]);

        DB::table('funcionalidades')->insert([
            'id' => 4,
            'nome' => 'Nota Fiscal de Serviço',
            'status' => 'A',
        ]);

        DB::table('funcionalidades')->insert([
            'id' => 5,
            'nome' => 'Repositório',
            'status' => 'A',
        ]);

        DB::table('funcionalidades')->insert([
            'id' => 6,
            'nome' => 'Exportar Dados',
            'status' => 'A',
        ]); 
    }
}

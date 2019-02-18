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
            'nome' => 'Usuarios',
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
            'nome' => 'Nota Fiscal de Servico',
            'status' => 'A',
        ]);

        DB::table('funcionalidades')->insert([
            'id' => 5,
            'nome' => 'Repositorio',
            'status' => 'A',
        ]);

        DB::table('funcionalidades')->insert([
            'id' => 6,
            'nome' => 'Exportar Dados',
            'status' => 'A',
        ]); 
    }
}

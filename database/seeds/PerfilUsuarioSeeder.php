<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerfilUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perfilusuario')->insert([
            'id' => 1,
            'nome' => 'Gestão Cliente',
            'status' => 'A',
        ]);

        DB::table('perfilusuario')->insert([
            'id' => 2,
            'nome' => 'Gestão Cliente Admin',
            'status' => 'A',
        ]);

        DB::table('perfilusuario')->insert([
            'id' => 3,
            'nome' => 'Gestão Bravo',
            'status' => 'A',
        ]);

        DB::table('perfilusuario')->insert([
            'id' => 4,
            'nome' => 'Fornecedor',
            'status' => 'A',
        ]);

        DB::table('perfilusuario')->insert([
            'id' => 5,
            'nome' => 'Administrador',
            'status' => 'A',
        ]);   
    }
}

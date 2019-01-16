<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissaoAcessoSeeder_2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissaoacesso')->insert([
            'id_perfil' => 4,
            'id_funcionalidade' => 2
        ]);

        DB::table('permissaoacesso')->insert([
            'id_perfil' => 4,
            'id_funcionalidade' => 5
        ]);

        DB::table('permissaoacesso')->insert([
            'id_perfil' => 2,
            'id_funcionalidade' => 1
        ]);

        DB::table('permissaoacesso')->insert([
            'id_perfil' => 2,
            'id_funcionalidade' => 2
        ]);

        DB::table('permissaoacesso')->insert([
            'id_perfil' => 2,
            'id_funcionalidade' => 3
        ]);

        DB::table('permissaoacesso')->insert([
            'id_perfil' => 2,
            'id_funcionalidade' => 4
        ]);

        DB::table('permissaoacesso')->insert([
            'id_perfil' => 2,
            'id_funcionalidade' => 5
        ]);

        DB::table('permissaoacesso')->insert([
            'id_perfil' => 2,
            'id_funcionalidade' => 6
        ]);

        DB::table('permissaoacesso')->insert([
            'id_perfil' => 1,
            'id_funcionalidade' => 2
        ]);

        DB::table('permissaoacesso')->insert([
            'id_perfil' => 1,
            'id_funcionalidade' => 3
        ]);

        DB::table('permissaoacesso')->insert([
            'id_perfil' => 1,
            'id_funcionalidade' => 4
        ]);

        DB::table('permissaoacesso')->insert([
            'id_perfil' => 1,
            'id_funcionalidade' => 5
        ]);

        DB::table('permissaoacesso')->insert([
            'id_perfil' => 1,
            'id_funcionalidade' => 6
        ]);

        DB::table('permissaoacesso')->insert([
            'id_perfil' => 3,
            'id_funcionalidade' => 2
        ]);

        DB::table('permissaoacesso')->insert([
            'id_perfil' => 3,
            'id_funcionalidade' => 3
        ]);

        DB::table('permissaoacesso')->insert([
            'id_perfil' => 3,
            'id_funcionalidade' => 4
        ]);

        DB::table('permissaoacesso')->insert([
            'id_perfil' => 3,
            'id_funcionalidade' => 5
        ]);

        DB::table('permissaoacesso')->insert([
            'id_perfil' => 3,
            'id_funcionalidade' => 6
        ]);

        DB::table('permissaoacesso')->insert([
            'id_perfil' => 5,
            'id_funcionalidade' => 1
        ]);

        DB::table('permissaoacesso')->insert([
            'id_perfil' => 5,
            'id_funcionalidade' => 2
        ]);

        DB::table('permissaoacesso')->insert([
            'id_perfil' => 5,
            'id_funcionalidade' => 3
        ]);

        DB::table('permissaoacesso')->insert([
            'id_perfil' => 5,
            'id_funcionalidade' => 4
        ]);

        DB::table('permissaoacesso')->insert([
            'id_perfil' => 5,
            'id_funcionalidade' => 5
        ]);

        DB::table('permissaoacesso')->insert([
            'id_perfil' => 5,
            'id_funcionalidade' => 6
        ]);
        
    }
}

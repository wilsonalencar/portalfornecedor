<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(PerfilUsuarioSeeder::class);
    	$this->call(FunionalidadesTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
    }
}

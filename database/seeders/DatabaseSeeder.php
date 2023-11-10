<?php

namespace Database\Seeders;

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
        \App\Models\User::factory(1)->create([
            "name" => "usuario",
            "email" => "usuario@usuario"
        ]);
        \App\Models\User::factory(1)->create([
            "id" => "10",
            "name"=>"toreto",
        ]);
        \App\Models\User::factory(1)->create([
            "id" => "20",
            "name"=>"choferpreba",
        ]);
        \App\Models\User::factory(1)->create([
            "id" => "47",
            "name"=>"usuario a listar",
        ]);
        \App\Models\User::factory(1)->create([
            "id" => "42",
            "name"=>"usuario a modificar",
        ]);
        \App\Models\User::factory(1)->create([
            "id" => "74",
            "name"=>"usuario a eliminar",
        ]);
        \App\Models\User::factory(1)->create([
            "name"=>"admin",
        ]);
        \App\Models\User::factory(1)->create([
            "name"=>"chofer",
        ]);
        \App\Models\User::factory(1)->create([
            "name"=>"almacenero",
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Poesia',
            'description' => 'Breve descripcion',
        ]);
        DB::table('categories')->insert([
            'name' => 'Ciencia ficcion',
            'description' => 'Descripcion mediana',
        ]);
    }
}

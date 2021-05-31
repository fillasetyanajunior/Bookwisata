<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu')->insert([
            'menu' => 'Utama',
            'icon' => 'fas fa-home'
        ]);
        DB::table('menu')->insert([
            'menu' => 'Layout',
            'icon' => 'fas fa-layer-group'
        ]);
        DB::table('menu')->insert([
            'menu' => 'Management',
            'icon' => 'fas fa-folder'
        ]);
        DB::table('menu')->insert([
            'menu' => 'Promosi',
            'icon' => 'fas fa-bullhorn'
        ]);
        DB::table('menu')->insert([
            'menu' => 'Konfirmasi',
            'icon' => 'fas fa-money-check'
        ]);
    }
}

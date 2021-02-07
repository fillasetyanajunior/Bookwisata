<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_menu')->insert([
            'menu_id' => '1',
            'sub_menu' => 'Dashboard',
            'icon' => 'fas fa-tachometer-alt',
            'url' => 'menu',
        ]);
        DB::table('sub_menu')->insert([
            'menu_id' => '1',
            'sub_menu' => 'Riwayat',
            'icon' => 'fas fa-history',
            'url' => 'riwayat',
        ]);
        DB::table('sub_menu')->insert([
            'menu_id' => '2',
            'sub_menu' => 'Menu',
            'icon' => 'fas fa-folder',
            'url' => 'menu',
        ]);
        DB::table('sub_menu')->insert([
            'menu_id' => '2',
            'sub_menu' => 'Sub Menu',
            'icon' => 'fas fa-folder',
            'url' => 'submenu',
        ]);
        DB::table('sub_menu')->insert([
            'menu_id' => '3',
            'sub_menu' => 'Promosi Bus',
            'icon' => 'fas fa-bus',
            'url' => 'bus',
        ]);
        DB::table('sub_menu')->insert([
            'menu_id' => '3',
            'sub_menu' => 'Promosi Mobil',
            'icon' => 'fas fa-car',
            'url' => 'mobil',
        ]);
        DB::table('sub_menu')->insert([
            'menu_id' => '3',
            'sub_menu' => 'Promosi Pusat Oleh-Oleh',
            'icon' => 'fas fa-balance-scale',
            'url' => 'pusat',
        ]);
        DB::table('sub_menu')->insert([
            'menu_id' => '3',
            'sub_menu' => 'Promosi Paket Wisata',
            'icon' => 'fas fa-archive',
            'url' => 'paket',
        ]);
        DB::table('sub_menu')->insert([
            'menu_id' => '3',
            'sub_menu' => 'Promosi Kapal Pesiar',
            'icon' => 'fas fa-ship',
            'url' => 'kapal',
        ]);
        DB::table('sub_menu')->insert([
            'menu_id' => '3',
            'sub_menu' => 'Promosi Hotel',
            'icon' => 'fas fa-hotel',
            'url' => 'hotel',
        ]);
        DB::table('sub_menu')->insert([
            'menu_id' => '3',
            'sub_menu' => 'Promosi Destinasi',
            'icon' => 'fas fa-plane',
            'url' => 'destinasi',
        ]);
        DB::table('sub_menu')->insert([
            'menu_id' => '3',
            'sub_menu' => 'Promosi Tour Guide',
            'icon' => 'fas fa-shuttle-van',
            'url' => 'guide',
        ]);
        DB::table('sub_menu')->insert([
            'menu_id' => '3',
            'sub_menu' => 'Promosi Kuliner',
            'icon' => 'fas fa-concierge-bell',
            'url' => 'kuliner',
        ]);
    }
}

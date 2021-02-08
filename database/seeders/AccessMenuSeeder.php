<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('access_menu')->insert([
            'menu_id' => '1',
            'role_id' => '1'
        ]);
        DB::table('access_menu')->insert([
            'menu_id' => '2',
            'role_id' => '1'
        ]);
        DB::table('access_menu')->insert([
            'menu_id' => '3',
            'role_id' => '1'
        ]);
        DB::table('access_menu')->insert([
            'menu_id' => '1',
            'role_id' => '2'
        ]);
        DB::table('access_menu')->insert([
            'menu_id' => '3',
            'role_id' => '2'
        ]);
        DB::table('access_menu')->insert([
            'menu_id' => '1',
            'role_id' => '3'
        ]);
    }
}

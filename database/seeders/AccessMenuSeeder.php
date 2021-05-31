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
        //Admin
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
            'menu_id' => '4',
            'role_id' => '1'
        ]);
         DB::table('access_menu')->insert([
            'menu_id' => '5',
            'role_id' => '1'
        ]);
        //Mitra
        DB::table('access_menu')->insert([
            'menu_id' => '1',
            'role_id' => '2'
        ]);
        DB::table('access_menu')->insert([
            'menu_id' => '4',
            'role_id' => '2'
        ]);
        //User
        DB::table('access_menu')->insert([
            'menu_id' => '1',
            'role_id' => '3'
        ]);
        DB::table('access_menu')->insert([
            'menu_id' => '5',
            'role_id' => '3'
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipekamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipekamar')->insert([
            'tipe' => 'Standar',
        ]);
        DB::table('tipekamar')->insert([
            'tipe' => 'Superior',
        ]);
        DB::table('tipekamar')->insert([
            'tipe' => 'Dulux',
        ]);
        DB::table('tipekamar')->insert([
            'tipe' => 'Junior Suite',
        ]);
        DB::table('tipekamar')->insert([
            'tipe' => 'Suite',
        ]);
        DB::table('tipekamar')->insert([
            'tipe' => 'Single',
        ]);
        DB::table('tipekamar')->insert([
            'tipe' => 'Twin',
        ]);
        DB::table('tipekamar')->insert([
            'tipe' => 'Double',
        ]);
        DB::table('tipekamar')->insert([
            'tipe' => 'Family',
        ]);
        DB::table('tipekamar')->insert([
            'tipe' => 'Connecting',
        ]);
        DB::table('tipekamar')->insert([
            'tipe' => 'Murphy',
        ]);
        DB::table('tipekamar')->insert([
            'tipe' => 'Accessible',
        ]);
        DB::table('tipekamar')->insert([
            'tipe' => 'Smoking',
        ]);
        DB::table('tipekamar')->insert([
            'tipe' => 'Cabana',
        ]);
        DB::table('tipekamar')->insert([
            'tipe' => 'Presidensial',
        ]);
    }
}

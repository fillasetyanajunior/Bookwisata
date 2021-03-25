<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            'name'              => 'Filla Setyana Junior',
            'email'             => 'pantailovina@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password'          => Hash::make("12345678"),
            'nomer'             => '087761660161',
            'role'              => 1,
            'avatar'            => '-',
            'is_active'         => 1,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);
        $this->call([
            TipekamarSeeder::class,
            MenuSeeder::class,
            SubMenuSeeder::class,
            AccessMenuSeeder::class,
        ]);
    }
}
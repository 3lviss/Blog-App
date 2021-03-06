<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(5).'@gmail.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('password'),
        ]);

        User::factory()
            ->count(50)
            ->hasPosts(1)
            ->create();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'Superadmin',
            'email' => 'superadmin@test.dev',
            'password' => Hash::make('123qweasd'),
            'role' => 'superadmin',
        ]);

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@test.dev',
            'password' => Hash::make('123qweasd'),
            'role' => 'admin',
        ]);

        DB::table('users')->insert([
            'name' => 'Operator',
            'email' => 'operator@test.dev',
            'password' => Hash::make('123qweasd'),
            'role' => 'operator',
        ]);

        DB::table('users')->insert([
            'name' => 'Owner',
            'email' => 'owner@test.dev',
            'password' => Hash::make('123qweasd'),
            'role' => 'owner',
        ]);


    }
}

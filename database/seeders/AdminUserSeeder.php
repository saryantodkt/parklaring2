<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('users')->insert(
        ['name' => 'Admin',
                'email' => 'administrator@dktindonesia.org',
                'password' => Hash::make('dkt@2025'),]
    );
    DB::table('users')->insert(
        ['name' => 'Ryan',
                'email' => 'ryan@dktindonesia.org',
                'password' => Hash::make('dkt@2025'),
                'is_admin' => true],
    );
    }
}

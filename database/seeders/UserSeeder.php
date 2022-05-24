<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        $admin = User::create([
            'nama' => 'Administrator',
            'email' => 'admin@email.com',
            'password' => Hash::make('password.1'),
            'avatar' => 'blank.png',
        ]);
        $admin->assignRole([1]);

        $dosen = User::create([
            'nama' => 'Muhammad Dede',
            'email' => 'm.dedenuraen@gmail.com',
            'password' => Hash::make('password.1'),
            'avatar' => 'blank.png',
        ]);
        $dosen->assignRole([2]);
    }
}

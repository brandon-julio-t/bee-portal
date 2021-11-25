<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => Str::uuid(),
            'name' => 'Administrator',
            'email' => 'admin@email.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
            'code' => 'Administrator',
        ]);
        User::create([
            'id' => Str::uuid(),
            'name' => 'Student',
            'email' => 'student@email.com',
            'password' => Hash::make('student'),
            'role' => 'student',
            'code' => '0000000000',
        ]);
        User::create([
            'id' => Str::uuid(),
            'name' => 'Lecturer',
            'email' => 'lecturer@email.com',
            'password' => Hash::make('lecturer'),
            'role' => 'lecturer',
            'code' => 'D0000',
        ]);
        User::factory()->count(100)->student()->create();
        User::factory()->count(100)->lecturer()->create();
    }
}

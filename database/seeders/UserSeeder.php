<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newuser = new User();
        $newuser->name = 'Andrea';
        $newuser->email = 'andrea@laravel.it';
        $newuser->password = 'password';
        $newuser->save();
    }
}

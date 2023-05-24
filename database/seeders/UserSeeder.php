<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();

        $user->name = "Super Admin";
        $user->avatar = null;
        $user->role = 0;
        $user->address = "Kupandole, Lalitpur, Nepal";
        $user->email = "admin@aphrodite.com.np";
        $user->email_verified_at = now();
        $user->password = Hash::make('@dmin2023');
        $user->assignRole('admin');
        $user->save();
    }
}

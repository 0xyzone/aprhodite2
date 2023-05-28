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
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@aphrodite.com.np',
            'email_verified_at' => now(),
            'password' => Hash::make('malaiktha1290')
        ]);
        $admin->assignRole('admin');

        $csr = User::create([
            'name' => 'CSR User',
            'email' => 'csr@aphrodite.com.np',
            'email_verified_at' => now(),
            'password' => Hash::make('malaiktha1290')
        ]);
        $csr->assignRole('csr');

        $rider = User::create([
            'name' => 'Rider',
            'email' => 'rider@aphrodite.com.np',
            'email_verified_at' => now(),
            'password' => Hash::make('malaiktha1290')
        ]);
        $rider->assignRole('rider');

        $manager = User::create([
            'name' => 'Manager',
            'email' => 'manager@aphrodite.com.np',
            'email_verified_at' => now(),
            'password' => Hash::make('malaiktha1290')
        ]);
        $manager->assignRole('manager');
    }
}

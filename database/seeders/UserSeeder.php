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
            'email' => 'admin@vidantaca.com.np',
            'email_verified_at' => now(),
            'password' => Hash::make('malaiktha1290')
        ]);
        $admin->assignRole('admin');

        $csr = User::create([
            'name' => 'CSR User',
            'email' => 'csr@vidantaca.com.np',
            'email_verified_at' => now(),
            'password' => Hash::make('malaiktha1290')
        ]);
        $csr->assignRole('csr');

        $rider = User::create([
            'name' => 'Rider',
            'email' => 'rider@vidantaca.com.np',
            'email_verified_at' => now(),
            'password' => Hash::make('malaiktha1290')
        ]);
        $rider->assignRole('rider');
    }
}

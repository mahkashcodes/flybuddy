<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Mahkash',
            'email' => 'mahkash.edu@gmail.com',
            'password' => Hash::make('Mahkash123'),
        ]);
        
        echo "Admin user created successfully!\n";
        echo "Email: mahkash.edu@gmail.com\n";
        echo "Password: Mahkash123\n";
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class MakeAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $email = 'mahkash.edu@gmail.com';

        $user = User::where('email', $email)->first();
        if ($user) {
            $user->is_admin = true;
            $user->save();
            $this->command->info("Set is_admin = 1 for {$email}");
        } else {
            $this->command->warn("User with email {$email} not found.");
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Users\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DfAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Soft',
            'last_name' => 'Squad',
            'email' => 'biuro@softsquad.pl',
            'password' => Hash::make('start123'),
            'is_active' => 1,
            'role' => User::$roles['R_ADMIN'],
            'is_terms' => 1,
            'is_newsletter' => 1
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            'name' => 'Test name',
            'email' => 'test@mail.ru',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'api_token' => '0AaS0M3nDWkrpbf1MallA5qufAVNYjRzkKQ8gJx9lyD6clPuFZuCPRuEO8AuU0z4LifawYIDHrcjjZsV',
            'remember_token' => Str::random(10),
        ]);
    }
}

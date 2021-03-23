<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Author::create([
            'name' => 'Николас',
            'surname' => 'Нассим',
            'patronymic' => 'Талеб',
            'birthday' => '2020-11-11'
        ]);
    }
}

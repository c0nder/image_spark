<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::create([
            'name' => 'Черный лебедь. Под знаком непредсказуемости (2-е изд., дополненное)',
            'cover' => 'https://cdn1.ozone.ru/s3/multimedia-c/wc1200/6010462692.jpg',
            'description' => 'За одно только последнее десятилетие человечество пережило ряд тяжелейших катастроф, потрясений и катаклизмов, не укладывающихся в рамки самых фантастических предсказаний.',
            'year' => 2021
        ]);
    }
}

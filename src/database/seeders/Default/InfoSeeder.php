<?php

namespace Database\Seeders\Default;

use App\Models\Info;
use Illuminate\Database\Seeder;

class InfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Info::create([
            'title' => 'RIKEDU',
            'description' =>
            'This is a cross-platform Flutter application designed for parents, students, and teachers to manage student information',
            'author' => 'Le Dinh Cuong',
            'keywords' => ['vietnam', 'school', 'control', 'rikedu'],
            'contact' => [
                'address' => [
                    'vi' =>
                    'Tầng 3, số nhà 10, đường Pervaya Tverskai-Yamkai, Mátxcơva',
                    'ru' =>
                    'Москва, Ул. Первая Тверская-Ямская (метро Белорусская), Дом 30, Ком 25, 3 Этаж',
                ],
                'phone' => '+7 985 733 61 61',
                'email' => 'dinhcuong.firewin99@gmail.com',
                'social' => [
                    'facebook' => 'https://www.facebook.com',
                    'telegram' => 'https://t.me/',
                    'youtube' => 'https://www.youtube.com',
                ],
            ],
            'image' => [
                'thumbnail' => 'https://picsum.photos/1200/630.webp',
                'cover' => 'https://picsum.photos/1600/900.webp',
            ],
        ]);
    }
}

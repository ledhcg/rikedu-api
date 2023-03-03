<?php

namespace Database\Seeders\Default;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Info;

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
            'title' => 'BAN CÁN SỰ ĐOÀN TẠI LIÊN BANG NGA',
            'description' =>
                'Trang thông tin chính thức của Ban Cán sự Đoàn tại Liên Bang Nga',
            'author' => 'BAN CÁN SỰ ĐOÀN TẠI LIÊN BANG NGA',
            'keywords' => ['vietnam', 'bcsd', 'luu hoc sinh', 'bcsdlbn'],
            'contact' => [
                'address' => [
                    'vi' =>
                        'Tầng 3, số nhà 10, đường Pervaya Tverskai-Yamkai, Mátxcơva',
                    'ru' =>
                        'Москва, Ул. Первая Тверская-Ямская (метро Белорусская), Дом 30, Ком 25, 3 Этаж',
                ],
                'phone' => '+7 961 212 3240',
                'email' => 'bcsdlbnga@gmail.com',
                'social' => [
                    'facebook' => 'https://www.facebook.com/bcsdlbn',
                    'telegram' => 'https://t.me/bcsdlbn',
                    'youtube' => 'https://www.youtube.com',
                ],
            ],
            'image' => [
                'thumbnail' => 'thumbnail.webp',
                'cover' => 'cover.webp',
            ],
        ]);
    }
}

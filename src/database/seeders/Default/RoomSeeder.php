<?php

namespace Database\Seeders\Default;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 12; $i++) {
            for ($j = 1; $j <= 15; $j++) {
                $room = '';
                if ($j < 10) {
                    $room .= $i . "0" . $j;
                } else {
                    $room .= $i . $j;
                }
                Room::factory()->create([
                    "name" => $room,
                ]);
            }
        }
    }
}

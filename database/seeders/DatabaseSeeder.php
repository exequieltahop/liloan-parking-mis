<?php

namespace Database\Seeders;

use App\Models\ParkingLog;
use App\Models\ParkingSlot;
use App\Models\User;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'liloan.port.admin',
            'email' => 'liloan.port.admin@email.com',
            'password' => Hash::make('}!N2=556itmX'),
        ]);

        for ($i = 1; $i <= 4; $i++) {
            ParkingSlot::create([
                'slot_no' => $i,
            ]);
        }

        $i = 1;
        $type = ['in', 'out'];

        $startDate = Carbon::create(2025, 1, 15);
        $endDate = Carbon::create(2025, 05, 10);

        while ($i <= 200) {
            $randomTimestamp = rand($startDate->timestamp, $endDate->timestamp);
            $randomDate = Carbon::createFromTimestamp($randomTimestamp)->setTimezone('Asia/Manila')->format('Y-m-d H:i:s');

            ParkingLog::insert([
                'slot_no' => rand(1, 4),
                'type' => $type[rand(0, 1)],
                'created_at' => $randomDate,
                'updated_at' => $randomDate,
            ]);

            $i++;
        }
    }
}

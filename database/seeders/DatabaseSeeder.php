<?php

namespace Database\Seeders;

use App\Models\ParkingLog;
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
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'admin@gmail.com',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123')
        ]);

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

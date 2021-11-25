<?php

namespace Database\Seeders;

use App\Models\Shift;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shifts = [
            ['description' => '1', 'start_time' => '07:20:00', 'end_time' => '09:00:00'],
            ['description' => '2', 'start_time' => '09:20:00', 'end_time' => '11:00:00'],
            ['description' => '3', 'start_time' => '11:20:00', 'end_time' => '13:00:00'],
            ['description' => '4', 'start_time' => '13:20:00', 'end_time' => '15:00:00'],
            ['description' => '5', 'start_time' => '15:20:00', 'end_time' => '17:00:00'],
            ['description' => '6', 'start_time' => '17:20:00', 'end_time' => '19:00:00'],
            ['description' => '7', 'start_time' => '19:20:00', 'end_time' => '21:00:00'],
            ['description' => 'All Day', 'start_time' => '00:00:00', 'end_time' => '23:59:00'],
        ];

        foreach ($shifts as $shift) {
            $data = collect($shift)->merge(['id' => Str::uuid()])->all();
            Shift::create($data);
        }
    }
}

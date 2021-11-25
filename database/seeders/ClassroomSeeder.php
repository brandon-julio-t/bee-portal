<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['B', 'L'] as $first) {
            foreach (range('A', 'Z') as $second) {
                foreach (range(0, 99) as $number) {
                    Classroom::create([
                        'id' => Str::uuid(),
                        'name' => sprintf('%s%s%02d', $first, $second, $number),
                    ]);
                }
            }
        }
    }
}

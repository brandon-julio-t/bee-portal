<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
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
        foreach (range(0, 99) as $number) {
            $code = collect(range('A', 'Z'))->random(2)->join('');
            Classroom::create([
                'id' => Str::uuid(),
                'name' => sprintf('%s%02d', $code, $number),
            ]);
        }
    }
}

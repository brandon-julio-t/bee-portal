<?php

namespace Database\Factories;

use App\Models\Classroom;
use App\Models\Semester;
use App\Models\Shift;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClassTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => Str::uuid()->toString(),
            'classroom_id' => Classroom::inRandomOrder()->first()->id,
            'shift_id' => Shift::inRandomOrder()->first()->id,
            'subject_id' => Subject::inRandomOrder()->first()->id,
            'semester_id' => Semester::inRandomOrder()->first()->id,
            'lecturer_id' => User::inRandomOrder()->where('role', 'lecturer')->first()->id,
        ];
    }
}

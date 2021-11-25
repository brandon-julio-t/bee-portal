<?php

namespace Database\Factories;

use App\Models\Classroom;
use App\Models\Semester;
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
            'subject_id' => Subject::inRandomOrder()->first()->id,
            'classroom_id' => Classroom::inRandomOrder()->first()->id,
            'semester_id' => Semester::orderByDesc('active_at')->take(3)->get()->random(),
            'lecturer_id' => User::inRandomOrder()->where('role', 'lecturer')->first()->id,
        ];
    }
}

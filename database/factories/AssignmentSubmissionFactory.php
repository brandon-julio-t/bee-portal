<?php

namespace Database\Factories;

use App\Models\Assignment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AssignmentSubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => Str::uuid(),
            'user_id' => User::inRandomOrder()->first()->id,
            'attachment' => 'answer.txt',
        ];
    }
}

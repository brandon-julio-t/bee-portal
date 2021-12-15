<?php

namespace Database\Factories;

use App\Models\ClassTransaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $start = $this->faker->dateTimeThisYear();
        $end = (new Carbon($start))->addWeeks(1)->toDateTime();
        return [
            'id' => Str::uuid(),
            'user_id' => User::inRandomOrder()->first()->id,
            'title' => $this->faker->sentence,
            'attachment' => 'case.txt',
            'start_at' => $start,
            'end_at' => $end,
        ];
    }
}

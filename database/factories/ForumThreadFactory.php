<?php

namespace Database\Factories;

use App\Models\ClassTransactionDetail;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ForumThreadFactory extends Factory
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
            'title' => $this->faker->sentence,
            'content' => collect($this->faker->paragraphs())->join("\n\n"),
            'attachment' => $this->faker->boolean ? 'case.txt' : null,
        ];
    }
}

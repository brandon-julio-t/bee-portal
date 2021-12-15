<?php

namespace Database\Factories;

use App\Models\ForumReply;
use App\Models\ForumThread;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ForumReplyFactory extends Factory
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
            'content' => collect($this->faker->paragraphs())->join('\n\n'),
            'attachment' => $this->faker->boolean ? 'answer.txt' : null,
        ];
    }
}

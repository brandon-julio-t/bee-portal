<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClassTransactionDetailFactory extends Factory
{
    private static $i = 1;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        if (self::$i > 12) self::$i = 1;
        $finish = $this->faker->dateTimeThisYear();
        $start = $this->faker->dateTimeThisYear($finish);
        return [
            'id' => Str::uuid(),
            'note' => collect($this->faker->paragraph(random_int(3, 5)))->join('\n'),
            'session' => self::$i++,
            'start_at' => $start,
            'finish_at' => $finish,
        ];
    }
}

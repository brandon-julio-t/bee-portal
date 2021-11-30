<?php

namespace Database\Factories;

use App\Models\Shift;
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
        return [
            'id' => Str::uuid(),
            'shift_id' => Shift::inRandomOrder()->first()->id,
            'note' => collect($this->faker->paragraph(random_int(3, 5)))->join('\n'),
            'session' => self::$i++,
            'transaction_date' => $this->faker->dateTimeThisYear(),
        ];
    }
}

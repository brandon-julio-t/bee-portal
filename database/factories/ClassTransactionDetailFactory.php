<?php

namespace Database\Factories;

use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClassTransactionDetailFactory extends Factory
{
    private static $i = 1;
    private static $transaction_date = null;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        if (self::$i > 12) self::$i = 1;

        if (self::$i === 1) {
            self::$transaction_date = $this->faker->dateTimeThisYear();
        } else {
            self::$transaction_date = (new Carbon(self::$transaction_date))->addWeeks(1)->toDate();
        }

        return [
            'id' => Str::uuid(),
            'shift_id' => Shift::inRandomOrder()->first()->id,
            'note' => collect($this->faker->paragraph(random_int(3, 5)))->join('\n'),
            'session' => self::$i++,
            'transaction_date' => self::$transaction_date,
        ];
    }
}

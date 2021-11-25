<?php

namespace Database\Seeders;

use App\Models\ClassTransaction;
use App\Models\ClassTransactionDetail;
use App\Models\ClassTransactionStudent;
use Illuminate\Database\Seeder;

class ClassTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClassTransaction::factory()->count(150)
            ->has(
                ClassTransactionDetail::factory()
                    ->count(12)
                    ->state(function (array $attributes, ClassTransaction $classTransaction) {
                        return ['class_transaction_id' => $classTransaction->id];
                    })
            )
            ->has(
                ClassTransactionStudent::factory()
                    ->count(30)
                    ->state(function (array $attributes, ClassTransaction $classTransaction) {
                        return ['class_transaction_id' => $classTransaction->id];
                    })
            )
            ->create();
    }
}

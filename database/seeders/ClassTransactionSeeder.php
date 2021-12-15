<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\ClassTransaction;
use App\Models\ClassTransactionDetail;
use App\Models\ClassTransactionStudent;
use App\Models\ForumReply;
use App\Models\ForumThread;
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
        ClassTransaction::factory()
            ->count(150)
            ->has(
                ClassTransactionStudent::factory()
                    ->count(30)
                    ->state(fn (array $attributes, ClassTransaction $classTransaction) => ['class_transaction_id' => $classTransaction->id])
            )->has(
                Assignment::factory()
                    ->count(3)
                    ->state(fn (array $attributes, ClassTransaction $classTransaction) => ['class_transaction_id' => $classTransaction->id])
                    ->has(
                        AssignmentSubmission::factory()
                            ->count(10)
                            ->state(fn (array $attributes, Assignment $assignment) => ['assignment_id' => $assignment->id])
                    )
            )->has(
                ClassTransactionDetail::factory()
                    ->count(12)
                    ->state(fn (array $attributes, ClassTransaction $classTransaction) => ['class_transaction_id' => $classTransaction->id])
                    ->has(
                        ForumThread::factory()
                            ->count(3)
                            ->state(fn (array $attributes, ClassTransactionDetail $classTransactionDetail) => ['class_transaction_detail_id' => $classTransactionDetail->id])
                            ->has(
                                ForumReply::factory()
                                    ->count(15)
                                    ->state(fn (array $attributes, ForumThread $forumThread) => ['forum_thread_id' => $forumThread->id])
                            )
                    )
            )->create();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            MenuSeeder::class,
            ShiftSeeder::class,
            SemesterSeeder::class,
            SubjectSeeder::class,
            ClassroomSeeder::class,
            ClassTransactionSeeder::class,
            ClassTransactionDetailSeeder::class,
            ClassTransactionStudentSeeder::class,
        ]);
    }
}

<?php

use App\Models\Classroom;
use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Subject::class)->constrained();
            $table->foreignIdFor(Classroom::class)->constrained();
            $table->foreignIdFor(Semester::class)->constrained();
            $table->foreignUuid('lecturer_id')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_transactions');
    }
}

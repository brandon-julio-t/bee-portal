<?php

use App\Models\ClassTransactionDetail;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_threads', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(ClassTransactionDetail::class)->constrained();
            $table->string('title');
            $table->text('content');
            $table->string('attachment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forum_threads');
    }
}

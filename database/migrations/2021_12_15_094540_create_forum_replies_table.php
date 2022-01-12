<?php

use App\Models\ForumReply;
use App\Models\ForumThread;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_replies', function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignIdFor(ForumThread::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(ForumReply::class)->nullable();
            $table->text('content');
            $table->string('attachment')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // these two are put here because primary key is created AFTER foreign key if using one-liner, causing error.
            // hence, we explicitly set constraint in following order
            $table->primary('id');
            $table->foreign('forum_reply_id')->references('id')->on('forum_replies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forum_replies');
    }
}

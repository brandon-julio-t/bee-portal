<?php

use App\Models\ForumReply;
use App\Models\ForumThread;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function () {
    Route::prefix('forums')->group(function () {
        Route::name('forums.')->group(function () {
            Route::get('/{forumThread}/replies', function (ForumThread $forumThread) {
                $replies = ForumReply::with([
                    'user' => fn (BelongsTo $query) => $query->whereNull('deleted_at')
                ])->where('forum_thread_id', $forumThread->id)
                    ->orderByDesc('created_at')
                    ->paginate(2);
                dd($replies);
                return $replies;
            })->name('replies');
        });
    });
});

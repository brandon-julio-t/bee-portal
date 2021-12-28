<?php

use App\Models\ForumReply;
use App\Models\ForumThread;
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
                $replies = ForumReply::with('user')
                    ->where('forum_thread_id', $forumThread->id)
                    ->paginate(3);
                return $replies;
            })->name('replies');
        });
    });
});

<?php

namespace App\Http\Controllers;

use App\Models\ClassTransactionDetail;
use App\Models\ForumReply;
use App\Models\ForumThread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ForumThreadController extends Controller
{
    public function view(ForumThread $forumThread)
    {
        $replies = $forumThread->forumReplies->sortByDesc('created_at');
        return view('general.forums.view', compact('forumThread', 'replies'));
    }

    public function create(Request $request, ClassTransactionDetail $classTransactionDetail)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'attachment' => 'file|mimes:zip,rar',
        ]);
        $user = Auth::user();
        $data = collect($data)->merge([
            'id' => Str::uuid(),
            'user_id' => $user->id,
            'class_transaction_detail_id' => $classTransactionDetail->id,
            'attachment' => optional($request->attachment)->store('forum_threads'),
        ])->all();

        return redirect()->route('general.forums.view', ForumThread::create($data))
            ->with('success', 'Forum created successfully.');
    }

    public function replyThread(Request $request, ForumThread $forumThread)
    {
        $data = $request->validate([
            'content' => 'required|string',
            'attachment' => 'file|mimes:zip,rar'
        ]);
        $user = Auth::user();
        $data = collect($data)->merge([
            'id' => Str::uuid(),
            'user_id' => $user->id,
            'forum_thread_id' => $forumThread->id,
            'attachment' => optional($request->attachment)->store('forum_replies'),
        ])->all();

        ForumReply::create($data);

        return redirect()->back()
            ->with('success', 'Reply success.');
    }
}

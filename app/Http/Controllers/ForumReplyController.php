<?php

namespace App\Http\Controllers;

use App\Models\ForumReply;
use App\Models\ForumThread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ForumReplyController extends Controller
{
    public function create(Request $request, ForumThread $forumThread)
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

    public function update(Request $request, ForumThread $forumThread, ForumReply $forumReply)
    {
        $this->authorize('update', $forumReply);

        $data = $request->validate([
            'content' => 'required|string',
            'attachment' => 'file|mimes:zip,rar'
        ]);
        $data['attachment'] = optional($request->attachment)->store('forum_replies') ?? $forumReply->attachment;

        $forumReply->fill($data);
        $forumReply->save();

        return redirect()->back()
            ->with('success', 'Reply updated successfully.');
    }

    public function delete(ForumThread $forumThread, ForumReply $forumReply)
    {
        $this->authorize('delete', $forumReply);
        $forumReply->delete();
        return redirect()->back()
            ->with('success', 'Reply deleted successfully.');
    }
}

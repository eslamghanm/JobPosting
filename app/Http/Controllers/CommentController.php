<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, JobPost $job)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);


        $job->comments()->create([
        'user_id' => Auth::id(),
        'content' => $request->input('content'),
        'parent_id' => $request->input('parent_id'),
    ]);
        return redirect()->back()->with('success', 'Comment added successfully!');
    }

    public function destroy(Comment $comment)
    {
        $user = Auth::user();

        $canDelete = $user->role === 'admin' ||
                     $user->id === $comment->user_id ||
                     ($comment->commentable_type === JobPost::class && $user->id === $comment->commentable->user_id);

        if (!$canDelete) {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        return back()->with('success', 'Comment deleted successfully.');
    }
}

<?php

namespace App\Repository;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentRepository implements CommentRepositoryInterface
{
    public function store($request)
    {
        try {
            $comment = new Comment();
            $comment->comment_body = $request->comment_body;
            $comment->user_id = Auth::user()->id;
            $comment->post_id = $request->post_id;
            $comment->save();
            return redirect()->route('Posts.show', ['Post' => $request->post_id]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update($request)
    {
        try {
            $comment = Comment::findOrFail($request->id);
            $comment->comment_body = $request->comment_body;
            $comment->user_id = Auth::user()->id;
            $comment->post_id = $request->post_id;
            $comment->save();
            return redirect()->route('Posts.show', ['id', $request->post_id]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($request)
    {
        try {
            Comment::findOrFai($request->id)->destroy();
            return redirect()->route('Posts.show', ['id', $request->post_id]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

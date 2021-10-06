<?php

namespace App\Http\Controllers;

use App\Http\Requests\comment\commentStore;
use App\Http\Requests\comment\commentUpdate;
use App\Repository\CommentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    protected $comment;
    public function __construct(CommentRepositoryInterface $comment)
    {
        $this->comment = $comment;
    }
    public function store(commentStore $request)
    {
        if (Auth::check()) {
            return $this->comment->store($request);
        } else {
            return redirect('login');
        }
    }
    public function update(commentUpdate $request)
    {
        if (Auth::check()) {
            return $this->comment->update($request);
        } else {
            return redirect('login');
        }
    }
    public function destroy(Request $request)
    {
        if (Auth::check()) {
            return $this->comment->destroy($request);
        } else {
            return redirect('login');
        }
    }
}

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
    public function index()
    {
        return $this->comment->index();
    }

    public function create()
    {
        if (Auth::check()) {
            return $this->comment->create();
        } else {
            return redirect('login');
        }
    }
    public function store(commentStore $request)
    {
        return $this->comment->store($request);
    }
    public function show($id)
    {
        return $this->comment->show($id);
    }
    public function edit($id)
    {
        if (Auth::check()) {
            return $this->comment->edit($id);
        } else {
            return redirect('login');
        }
    }
    public function update(commentUpdate $request)
    {
        return $this->comment->update($request);
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

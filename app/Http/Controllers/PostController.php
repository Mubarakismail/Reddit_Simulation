<?php

namespace App\Http\Controllers;

use App\Http\Requests\post\postStore;
use App\Http\Requests\post\postUpdate;
use App\Models\Post;
use App\Repository\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    protected $post;
    public function __construct(PostRepositoryInterface $post)
    {
        $this->post = $post;
    }
    public function index()
    {
        return $this->post->index();
    }
    public function create()
    {
        if (Auth::check()) {
            return $this->post->create();
        } else {
            return redirect('login');
        }
    }
    public function store(postStore $request)
    {
        return $this->post->store($request);
    }
    public function show($id)
    {
        return $this->post->show($id);
    }
    public function edit($id)
    {
        if (Auth::check()) {
            return $this->post->edit($id);
        } else {
            return redirect('login');
        }
    }
    public function update(postUpdate $request)
    {
        return $this->post->update($request);
    }
    public function destroy(Request $request)
    {
        if (Auth::check()) {
            return $this->post->destroy($request);
        } else {
            return redirect('login');
        }
    }
    public function upVote($Post)
    {
        if (Auth::check()) {
            $post = Post::findOrFail($Post);
            DB::table('user_post_vote')->where('user_id', Auth::user()->id)
                ->where('post_id', $post->id)->delete();
            DB::table('user_post_vote')->insert([
                'user_id' => Auth::user()->id,
                'post_id' => $post->id
            ]);
            return redirect()->back();
        } else {
            return redirect('login');
        }
    }
    public function downVote($Post)
    {
        if (Auth::check()) {
            $post = Post::findOrFail($Post);
            DB::table('user_post_vote')->where('user_id', Auth::user()->id)->where('post_id', $post->id)->delete();
            return redirect()->back();
        } else {
            return redirect('login');
        }
    }
}

<?php

namespace App\Repository;

use App\Models\Community;
use App\Models\community_tag;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostRepository implements PostRepositoryInterface
{
    public function index()
    {
        if (Auth::check()) {
            $users = DB::table('friends')->where('user_id', '=', Auth::user()->id)->get();
            $posts = DB::table('posts')->whereIn('user_id', '=', $users)
                ->orWhere('user_id', '=', Auth::user()->id)
                ->get();
        } else {
            $posts = Post::where('post_privacy', 1)->get();
        }
        $Communities = DB::table('communities')->orderBy('numberOfMembers', 'desc')->limit(5)->get();
        return view('Posts.index', compact('posts', 'Communities'));
    }
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $tags = community_tag::select('tag_name')->where('community_id', '=', $post->community_id)->get();
        $idsOfCommunities = community_tag::select('community_id')->whereIn('tag_name', '=', $tags)->get();
        $Communities = Community::whereIn('id', '=', $idsOfCommunities)->get();
        return view('Posts.showPost', compact('post', 'Communities'));
    }
    public function create()
    {
        return view('Posts.CreatePost');
    }
    public function store($request)
    {
        try {
            $post = new Post();
            $post->post_title;
            $post->post_image;
            $post->post_video;
            $post->post_body;
            $post->post_url;
            $post->post_privacy;
            $post->save();
            toastr()->success('Data Saved Completed');
            return redirect()->route('Posts.index');
        } catch (\Exception $e) {
            return redirect() - back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        $post = Post::findOrFal($id);
        return view('Posts.CreatePost', compact('post'));
    }
    public function update($request)
    {
        try {
            $post = Post::findOrFail($request->id);
            $post->post_title;
            $post->post_image;
            $post->post_video;
            $post->post_body;
            $post->post_url;
            $post->post_privacy;
            $post->save();
            toastr()->success('Data Updated Completed');
            return redirect()->route('Posts.index');
        } catch (\Exception $e) {
            return redirect() - back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($request)
    {
        try {
            Post::findOrFail($request->id)->destroy();
            toastr()->error('Post Deleted Successfully');
            return redirect()->route('Posts.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

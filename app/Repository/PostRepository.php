<?php

namespace App\Repository;

use App\Models\Comment;
use App\Models\Community;
use App\Models\community_tag;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostRepository implements PostRepositoryInterface
{
    public function index()
    {
        if (Auth::check()) {
            $friends = DB::table('friends')->where('friend_id', '=', Auth::user()->id)->where('accepted', '=', 1)->get();
            $idsOfFriends = [];
            foreach ($friends as $friend) {
                array_push($idsOfFriends, $friend->user_id);
            }
            $posts = Post::whereIn('user_id', $idsOfFriends)
                ->orWhere('user_id', '=', Auth::user()->id)->get();
        } else {
            $posts = Post::where('post_privacy', 1)->get();
        }
        $Communities = DB::table('communities')->orderBy('numberOfMembers', 'desc')->limit(5)->get();
        $NewestPosts = Post::orderBy('created_at')->limit(5)->get();
        return view('Posts.index', compact('posts', 'Communities', 'NewestPosts'));
    }
    public function show($Post)
    {
        $post = Post::findOrFail($Post);
        $tags = community_tag::select('tag_name')->where('community_id', '=', $post->community_id)->get();
        $idsOfCommunities = community_tag::select('community_id')->whereIn('tag_name', $tags)->get();
        $Communities = Community::whereIn('id', $idsOfCommunities)->orderBy('numberOfMembers', 'desc')->get();
        $comments = Comment::where('post_id', '=', $post->id)->get();
        $NewestPosts = Post::orderBy('created_at')->limit(5)->get();
        return view('Posts.showPost', compact('post', 'Communities', 'comments', 'NewestPosts'));
    }
    public function create()
    {
        $idsOfCommunities = DB::table('community_user')->where('user_id', '=', Auth::user()->id)->get(['Community_id']);
        $Communities = Community::whereIn('id', $idsOfCommunities)->get();
        return view('Posts.CreatePost', compact('Communities'));
    }
    public function store($request)
    {
        try {
            $post = new Post();

            if ($request->post_photo != null) {
                $photo_extinsion = $request->post_photo->getClientOriginalExtension();
                $photo_name = time() . '.' . $photo_extinsion;
                $path = 'images/upload';
                $request->post_photo->move($path, $photo_name);
                $post->post_photo = $photo_name;
            }

            if ($request->post_video != null) {
                $video_extinsion = $request->post_video->getClientOriginalExtension();
                $video_name = time() . '.' . $video_extinsion;
                $path = 'images/upload';
                $request->post_photo->move($path, $video_name);
                $post->post_video = $video_name;
            }

            $post->post_title = $request->post_title;

            if ($request->post_body != null) {
                $post->post_body = $request->post_body;
            }
            if ($request->post_url != null) {
                $post->post_url = $request->post_url;
            }
            $post->user_id = Auth::user()->id;
            $post->save();
            toastr()->success('Data Saved Completed');
            return redirect()->route('Posts.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
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
            if ($request->post_photo != null) {
                $photo_extinsion = $request->post_photo->getClientOriginalExtension();
                $photo_name = time() . '.' . $photo_extinsion;
                $path = 'images/upload';
                $request->post_photo->move($path, $photo_name);
                $post->post_photo = $photo_name;
            }

            if ($request->post_video != null) {
                $video_extinsion = $request->post_video->getClientOriginalExtension();
                $video_name = time() . '.' . $video_extinsion;
                $path = 'images/upload';
                $request->post_photo->move($path, $video_name);
                $post->post_video = $video_name;
            }

            $post->post_title = $request->post_title;

            if ($request->post_body != null) {
                $post->post_body = $request->post_body;
            }
            if ($request->post_url != null) {
                $post->post_url = $request->post_url;
            }
            $post->user_id = Auth::user()->id;
            $post->save();
            toastr()->success('Data Updated Completed');
            return redirect()->route('Posts.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
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

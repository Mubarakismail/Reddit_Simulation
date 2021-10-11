<?php

namespace App\Repository;

use App\Models\Community;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class CommunityRepository implements CommunityRepositoryInterface
{
    public function index()
    {
        $Communities = Community::orderBy('numberOfMembers', 'desc')->paginate(10);
        return view('Community.index', compact('Communities'));
    }
    public function show($id)
    {
        $Community = Community::findOrFail($id);
        $posts = Post::where('community_id', '=', $Community->id)->get();
        $tags = DB::table('community_tags')->where('community_id', $Community->id)->get();
        return view('Community.Show', compact('Community', 'posts', 'tags'));
    }
    public function store($request)
    {
        try {
            $community = new Community();
            $community->community_name = $request->title;
            $community->community_privacy = $request->community_privacy;
            $community->description = $request->description;
            $community->save();
            toastr()->success('Community Created Successfully, Have fun');
            return redirect()->route('Communities.show', ['Community' => $community->id]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update($request)
    {
        try {
            $community = Community::findOrFail($request->id);
            $community->community_name = $request->title;
            $community->community_privacy = $request->community_privacy;
            $community->description = $request->description;
            $community->save();
            toastr()->success('Community Updated Successfully, Have fun');
            return redirect()->route('Communities.show', ['Community' => $community->id]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($request)
    {
        try {
            Community::findOrFail($request->id)->destroy();
            toastr()->error('Community Deleted Successfully');
            return redirect()->route('Posts.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

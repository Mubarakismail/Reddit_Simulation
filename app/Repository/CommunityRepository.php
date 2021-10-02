<?php

namespace App\Repository;

use App\Models\Community;

class CommunityRepository implements CommunityRepositoryInterface
{
    public function index()
    {
        $Communities = Community::orderBy('numberOfMembers', 'desc')->get();
        return view('Community.index', compact('Communities'));
    }
    public function show($id)
    {
        $Community = Community::findOrFail($id);
        return view('Community.Show', compact('Community'));
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
            return redirect()->route('Communities.show', ['id' => $community->id]);
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
            return redirect()->route('Communities.show', ['id' => $community->id]);
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

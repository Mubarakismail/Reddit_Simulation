<?php

namespace App\Http\Controllers;

use App\Http\Requests\community\communityStore;
use App\Http\Requests\community\communityUpdate;
use App\Models\Community;
use App\Models\Post;
use App\Repository\CommunityRepositoryInterface;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    protected $community;
    public function __construct(CommunityRepositoryInterface $community)
    {
        $this->community = $community;
    }
    public function index()
    {
        return $this->community->index();
    }
    public function store(communityStore $request)
    {
        return $this->community->store($request);
    }
    public function show($id)
    {
        return $this->community->show($id);
    }
    public function update(communityUpdate $request)
    {
        return $this->community->update($request);
    }
    public function destroy(Request $request)
    {
        if (Auth::check()) {
            return $this->community->destroy($request);
        } else {
            return redirect('login');
        }
    }
    public function join($community)
    {
        $Community = Community::findOrFail($community);
        $Community->numberOfMembers++;
        DB::table('community_user')->insert([
            'user_id' => Auth::user()->id,
            'Community_id' => $Community->id,
            'user_type' => 'member',
        ]);
        $Community->save();
        return redirect()->route('Communities.show', ['Community' => $community->id]);
    }
}

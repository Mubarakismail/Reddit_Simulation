<?php

namespace App\Http\Controllers;

use App\Http\Requests\community\communityStore;
use App\Http\Requests\community\communityUpdate;
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
    public function create()
    {
        if (Auth::check()) {
            return $this->community->create();
        } else {
            return redirect('login');
        }
    }
    public function store(communityStore $request)
    {
        return $this->community->store($request);
    }
    public function show($id)
    {
        return $this->community->show($id);
    }
    public function edit($id)
    {
        if (Auth::check()) {
            return $this->community->edit($id);
        } else {
            return redirect('login');
        }
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
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UpdateUser;
use App\Models\Post;
use App\Models\User;
use App\Notifications\Friendship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($User)
    {
        $user = User::findOrFail($User);
        $posts = Post::where('user_id', '=', $user->id)->get();
        $friendship = DB::table('friends')->where('user_id', '=', Auth::user()->id)->where('friend_id', '=', $user->id)->get();
        if (isset($friendship) && sizeof($friendship) > 0) {
            if ($friendship[0]->accepted && $friendship[0]->sent) {
                $friendship = null;
            } else if (!$friendship[0]->accepted && $friendship[0]->sent) {
                $friendship = "Friendship request sent";
            } else {
                $friendship = "Add Friend";
            }
        } else {
            $friendship = "Add Friend";
        }
        return view('User.Friend', compact('posts', 'user', 'friendship'));
    }
    public function edit($User)
    {
        $user = User::findOrFail($User);
        $posts = Post::where('user_id', '=', $User)->get();
        $friendRequestUsers = [];
        foreach ($user->notifications as $key => $not) {
            array_push($friendRequestUsers, $not->data['user_id']);
        }
        $friendshipRequests = User::whereIn('id', $friendRequestUsers)->get();
        return view('User.Profile', compact('user', 'posts', 'friendshipRequests'));
    }
    public function update(UpdateUser $request)
    {
        try {
            $user = User::findOrFail($request->id);
            $user->username = $request->username;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            if ($request->profile_photo != null) {
                $photo_extinsion = $request->profile_photo->getClientOriginalExtension();
                $photo_name = time() . '.' . $photo_extinsion;
                $path = 'images/upload';
                $request->profile_photo->move($path, $photo_name);
                $user->profile_photo = $photo_name;
            }
            $user->gender = $request->gender;
            $user->birth_date = $request->birth_date;
            $user->education = $request->education;
            $user->bio = $request->bio;
            $user->address = $request->address;
            $user->password = Hash::make($request->password);
            $user->save();
            toastr()->success('Profile Updated Successfully');
            return redirect()->route('Posts.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($User)
    {
        try {
            $user = User::findOrFail($User);
            Auth::logout();
            $user->delete();
            toastr()->error('Profile Deleted Successfully');
            return redirect()->route('Posts.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function sendRequest($User)
    {
        $user = User::findOrFail($User);
        $friendship = new Request();
        $friendship->friend_id = $user->id;
        $friendship->user_id = Auth::user()->id;
        $user->notify(new Friendship($friendship));
        toastr()->success('Friendship request sent successfully');
        DB::table('friends')->insert([
            'user_id' => Auth::user()->id,
            'friend_id' => $user->id,
            'accepted' => false,
            'sent' => true,
        ]);
        return redirect()->route('Users.show', ['User' => $user->id]);
    }
    public function acceptRequest($User)
    {
        $user = User::findOrFail($User);
        $friendship = DB::table('friends')->where('user_id', '=', $user->id)
            ->where('friend_id', '=', Auth::user()->id)->get();
        $friendship[0]->accepted = 1;
        $data = (array)$friendship[0];
        DB::table('friends')->where('id', '=', $friendship[0]->id)->update($data);
        toastr()->success($user->username . ' accept friendship request');
        $data = "{";
        $data .= "\"user_id\":";
        $data .= $user->id;
        $data .= ",\"friend_id\":";
        $data .= Auth::user()->id;
        $data .= "}";
        /* dd($data); */
        DB::table('notifications')->where('data', $data)->delete();
        return redirect()->back();
    }
    public function declineRequest($User)
    {
        $user = User::findOrFail($User);
        $friendship = DB::table('friends')->where('user_id', '=', $user->id)
            ->where('friend_id', '=', Auth::user()->id)->get();
        $friendship->sent = false;
        $friendship->save();
        $data = "{";
        $data .= "\"user_id\":";
        $data .= $user->id;
        $data .= ",\"friend_id\":";
        $data .= Auth::user()->id;
        $data .= "}";
        /* dd($data); */
        DB::table('notifications')->where('data', $data)->delete();
        return redirect()->back();
    }
}

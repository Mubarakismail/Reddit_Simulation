<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UpdateUser;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    public function edit($User)
    {
        $user = User::findOrFail($User);
        $posts = Post::where('user_id', '=', $User)->get();
        return view('User.Profile', compact('user', 'posts'));
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
}

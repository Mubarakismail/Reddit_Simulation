<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function update(UpdateUser $request)
    {
        try {
            $user = User::findOrFail($request->id);
            $user->username = $request->username;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->profile_photo = $request->profile_photo;
            $user->geneder = $request->geneder;
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
    public function destroy(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);
            Auth::logout();
            $user->delete();
            toastr()->error('Profile Deleted Successfully');
            return redirect()->route('Posts.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    protected $user;

    public function __contruct(User $user)
    {
        $this->middleware('auth');
        $this->user = $user;
    }

    public function profile()
    {
        return view('profile');
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'cover-image' => 'image|nullable|max:1999',
            'name' => 'required|max:50',
            'email' => 'required'
        ]);

        if($request->hasFile('cover-image')) {
            $filenameWithExt = $request->file('cover-image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // dd($filename);
            $extension = $request->file('cover-image')->getClientOriginalExtension();
            $filenameToStore = $filename. '_'. time(). '.'. $extension;
            $path = $request->file('cover-image')->storeAs('cover_images', $filenameToStore);
        }else {
            $filenameToStore = 'no_image.jpg';
        }
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->cover_image = $filenameToStore;
        $user->save();
        // dd(Storage::url($path));

        return redirect('/profile');
    }
}

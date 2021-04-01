<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Post;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->except('show');
    }

    // Show Authors public profile
    public function show($id)
    {
        $user = User::find($id);

        $total_posts = Post::where('user_id', $user->id)
                        ->get()
                        ->count();

        return view('user/show')->with([
            'user' => $user,
            'total_posts' => $total_posts
            ]);
    }

    // Show Edit Profile Form
    public function edit($id)
    {
        $user = User::find($id);

        return view('user/edit')->with('user', $user);
    }

    // Update Profile Changes
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50',
        ]);

        $user = User::find($id);

        $user->name = $request->input('name');
        $user->save();

        return redirect('user/' . $user->id . '/edit')->with('success', 'Profile updated successfully');
    }

    // Change Password
    public function update_password(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|string|min:6',
        ]);

        $user = User::find($id);

        $user->password = Hash::make($request->input('password')); 
        $user->save();

        return redirect('user/' . $user->id . '/edit')->with('success', 'Password changed successfully');
    }

    // Delete Account
    public function delete_account(Request $request, $id)
    {
        $this->validate($request, [
            'del_password' => 'required',
        ]);

        // Find User
        $user = User::find($id);

        // Find All User's posts
        $posts = Post::where('user_id', $user->id)->get(); 

        if(Hash::check($request->input('del_password'), $user->password))
        {
            $user->deleted = 1;

            if($user->save())
            {
                foreach ($posts as $post) {
                    $post->deleted = 1; // Delete Every Post
                    $post->save();
                }
                
            }
        }

        auth()->logout(); // Logout
        
        return redirect('/');
    }
}

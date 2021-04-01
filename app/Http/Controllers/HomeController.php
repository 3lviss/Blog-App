<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::with('user')
                        ->where('deleted', 0)
                        ->where('user_id', Auth::id())
                        ->orderBy('updated_at', 'desc')
                        ->paginate(15);

        $user = User::find(Auth::id());

        return view('home')->with([
            'posts' => $posts,
            'user' => $user
        ]);
    }
}

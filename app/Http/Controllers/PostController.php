<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user')
                        ->where('deleted', 0)
                        ->orderBy('updated_at', 'desc')
                        ->paginate(5);

        return view('index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image',
            'title' => 'required|string|max:50',
            'body' => 'required|string|max:5000',
        ]);

        // Get Original Image Name With Extension
        $filenameWithExtension = $request->file('image')->getClientOriginalName();
        // Get Only Image Name Without Extension
        $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
        // Get Image Extension
        $extension = $request->file('image')->getClientOriginalExtension();
        // Create Nane For Store (Adding timestamps between name and extension)
        $filenameToStore = $filename . '_' . time() . '.' . $extension;
        // Store the Image
        $path = $request->file('image')->storeAs('public/posts/', $filenameToStore);

        $post = new Post;
        $post->user_id = Auth::id();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->image = $filenameToStore;
        $post->save();

        return redirect('/')->with('success', 'Post added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        return view('post/show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        return view('post/edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'new_image' => 'image',
            'title' => 'required|string|max:50',
            'body' => 'required|string|max:5000',
        ]);

        $post = Post::find($id);

        // Check if is selected a new image
        if(!empty($request->file('new_image')))
        {
            Storage::delete('public/posts/' . $post->image);

            // Get Original Image Name With Extension
            $filenameWithExtension = $request->file('new_image')->getClientOriginalName();
            // Get Only Image Name Without Extension
            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            // Get Image Extension
            $extension = $request->file('new_image')->getClientOriginalExtension();
            // Create Nane For Store (Adding timestamps between name and extension)
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            // Store the Image
            $path = $request->file('new_image')->storeAs('public/posts/', $filenameToStore);

            $post->image = $filenameToStore;
        }

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        
        $post->save();

        return redirect('/')->with('success', 'Post edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->deleted = 1;
        $post->save();

        return redirect('/')->with('success', 'Post deleted successfully');
    }
}

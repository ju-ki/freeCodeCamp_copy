<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        # for new user
        if ($users->count() == 0)
        {
            $posts = Post::with('user')->latest()->paginate(10);
        }
        else
        {
            $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(10);
        }
        return view('posts.index', compact('posts'));
    }


    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image']
        ]);

        $imagePath = request('image')->store('uploads', 'public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath
        ]);

        return redirect('/profile/' . auth()->user()->id);
    }


    public function show(\App\Post $post)
    {
        return view('posts.show', compact('post'));
    }


    # add delete post function
    public function delete(\App\Post $post)
    {
        $post = Post::find($post->id);
        $post->delete();
        return redirect('/profile/' . auth()->user()->id);
    }
}

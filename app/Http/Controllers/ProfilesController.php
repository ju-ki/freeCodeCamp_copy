<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    //

    public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $postCount = Cache::remember('count.posts.'. $user->id, now()->addSeconds(30) ,function () use ($user) {
            return $user->posts->count();
        });

        $followersCount = Cache::remember('count.followersCount.'. $user->id, now()->addSeconds(30) ,function () use ($user) {
            return $user->profile->followers->count();
        });

        $followers = Cache::remember('count.followers.'. $user->id, now()->addSeconds(30) ,function () use ($user) {
            return $user->profile->followers;
        });

        $followingCount = Cache::remember('count.followingCount.'. $user->id, now()->addSeconds(30) ,function () use ($user) {
            return $user->following->count();
        });

        $followings = Cache::remember('count.following.'. $user->id, now()->addSeconds(30) ,function () use ($user) {
            return $user->following;
        });



        return view('profiles.index', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount', 'followers', 'followings'));
    }


    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }


    public function update(User $user)
    {
        $this->authorize('update', $user->profile);
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);

        $imagePath = '';

        if(request('image'))
        {
            $imagePath = request('image')->store('profile', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();
        }


        auth()->user()->profile->update(array_merge(
            $data,
            ['image' => $imagePath]
        ));

        return redirect("/profile/{$user->id}");
    }
}



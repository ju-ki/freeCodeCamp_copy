@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="{{ $user->profile->profileImage() }}" class="rounded-circle w-100">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-baseline pb-3">
                    <div class="h4 pr-3">
                        {{ $user->username }}
                    </div>
                    <div>
                        @can('update', $user->profile)
                        <a href="/p/create" class="btn btn-primary">Add New Post</a>
                        @else
                        <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                        @endcan
                    </div>
                </div>
            </div>
            @can('update', $user->profile)
                <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
            @endcan
            <div class="d-flex">
                <div class="pr-3"><strong>{{ $postCount }}</strong> posts</div>
                <div class="pr-3"><strong>{{ $followers }}</strong> follwers</div>
                <div class="pr-3"><strong>{{ $following }}</strong> following</div>
            </div>
            <div class="pt-5 font-weight-bold">{{ $user->profile->title}}</div>
            <div>{{ $user->profile->description}}</div>
            <div><a href="#">{{ $user->profile->url}}</a></div>
        </div>
    </div>
    <hr>
    @if($user->posts->count() === 0)
        <div class="d-flex justify-content-center">
            <div class="h3">Upload You're Favorite Photo!</div>
        </div>
        <div class="d-flex justify-content-center">
            @can('update', $user->profile)
            <a href="/p/create" class="">Share your're first Photo</a>
            @endcan
        </div>
    @else
        <div class="row pt-4">
            @foreach ($user->posts as  $post)
                <div class="col-4 pb-4">
                    <a href="/p/{{ $post->id }}">
                        <img src="/storage/{{ $post->image }}" alt="{{ $post->caption }}" class="w-100">
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

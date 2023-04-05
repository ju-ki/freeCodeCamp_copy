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
                <div class="pr-3"><a href="" class="text-dark" data-toggle="modal" data-target="#followerModal"><strong>{{ $followersCount }}</strong> follwers</a></div>
                <div class="pr-3"><a href="" class="text-dark" data-toggle="modal" data-target="#followingModal"><strong>{{ $followingCount }}</strong> following</a></div>
            </div>
            
            <div class="modal fade" id="followerModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>followers</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">×</button>
                        </div>
                        <div class="modal-body">
                            @foreach ($followers as $follower)
                            <div class="">
                                <div class="d-flex align-items-center">
                                    <div class="pl-2">
                                        <a href="/profile/{{ $follower->profile->id }}"><img src="{{ $follower->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 50px"></a>
                                    </div>
                                    <div class="flex-grow-1 mx-2 pt-3">
                                        <a href="/profile/{{ $follower->profile->id }}" class="text-dark"><p><strong>{{ $follower->name }}</strong></p></a>
                                        <p>{{ $follower->profile->description }}</p>
                                    </div>
                                    <div class="text-right pr-2">
                                        <follow-button user-id="{{ $follower->profile->id }}" follows="{{ $user->following->contains($follower->profile->id) }}"></follow-button>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="followingModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>followings</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">×</button>
                        </div>
                        <div class="modal-body">
                            @foreach ($followings as $following)
                            <div class="card">
                                <div class="d-flex align-items-center">
                                    <div class="pl-2">
                                        <a href="/profile/{{ $following->user->id }}"><img src="{{ $following->profileImage() }}" class="rounded-circle w-100" style="max-width: 50px"></a>
                                    </div>
                                    <div class="flex-grow-1 mx-2 pt-3">
                                        <a href="/profile/{{ $following->user->id }}" class="text-dark"><p><strong>{{ $following->user->username }}</strong></p></a>
                                        <p>{{ $following->description }}</p>
                                    </div>
                                    <div class="text-right pr-2">
                                        <follow-button user-id="{{ $following->user->id }}" follows="{{ $following->user->following->contains($user->id) }}"></follow-button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>



            <div class="pt-5 font-weight-bold">{{ $user->profile->title}}</div>
            <div>{{ $user->profile->description}}</div>
            <div><a href="#">{{ $user->profile->url}}</a></div>
        </div>
    </div>
    <hr>
    @if($postCount === 0)
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

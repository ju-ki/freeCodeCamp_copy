@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <img src="/storage/{{ $post->image }}" class="w-100">
            </div>
            <div class="col-4">
                <div>
                    <div class='d-flex align-items-center'>
                        <div class="pr-3">
                            <img src="{{ $post->user->profile->profileImage() }}" alt="" class="w-100 rounded_circle"
                                style="max-width: 50px">
                        </div>
                        <div>
                            <div class="font-weight-bold">
                                <a href="/profile/{{ $post->user->id }}">
                                    <span class="text-dark">{{ $post->user->username }}
                                    </span>
                                </a>
                                <a href="#" class="pl-3 pr-3">Follow</a>
                                <form id="delete-form" action="{{ route('post.destroy',  ['post'=>$post->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <delete-button>Delete</delete-button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div>
                        <hr>
                        <p>
                            <span class="font-weight-bold">
                                <a href="/profile/{{ $post->user->id }}">
                                    <span class="text-dark">
                                        {{ $post->user->username }}
                                    </span>
                                </a>
                            </span>
                            {{ $post->caption }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endsection

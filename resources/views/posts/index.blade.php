@extends('layouts.app')
@section('content')
    <div class="container">
        @foreach ($posts as $post)
            <div class="card row pb-4">
                <div class="col-8 offset-2 py-3">
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
                                    <a href="#" class="pl-3">Follow</a>
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

                    <div class="col-8 offset-2">
                        <a href="/profile/{{ $post->user->id }}">
                            <img src="/storage/{{ $post->image }}" class="w-100">
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection

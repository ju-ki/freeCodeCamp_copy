@section('content')
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

@endsection


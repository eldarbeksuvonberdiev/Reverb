@extends('message.chat_layout')

@section('title', 'Mian chat')


@section('content')
    <div class="row">
        <div class="col-4 mt-5">
            @forelse ($users as $user)
                <a href="/chat-with/{{ $user->id }}" class="btn btn-outline-primary mt-2" style="width: 100%;">{{ $user->name }}</a><br>
            @empty
                <h4 style="color: red;">No users</h4>
            @endforelse
        </div>
        <div class="col-8">
            <h3>Chat</h3>
        </div>
    </div>
@endsection

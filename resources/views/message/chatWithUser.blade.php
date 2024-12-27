@extends('message.chat_layout')

@section('title', 'Chat with User')


@section('content')
    <div class="row">
        <div class="col-4 mt-5">
            @forelse ($users as $user)
                <a href="/chat-with/{{ $user->id }}" class="btn btn-outline-primary">{{ $user->name }}</a>
            @empty
                <h4 style="color: red;">No users</h4>
            @endforelse
        </div>
        <div class="col-8 mt-5">
            @forelse ($messages as $message)
                <h5><strong style="color: red">{{ $message->sender->name }}:</strong>{{ $message->message }}</h5>
            @empty
                <h5>No message</h5>
            @endforelse
            <form action="/chat-to/{{ $chatUser->id }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-9">
                        <input type="text" class="form-control mt-5" name="message" placeholder="Your message...">
                        @error('message')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-primary mt-5"><i class="bi bi-send"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

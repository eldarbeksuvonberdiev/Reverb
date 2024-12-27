@extends('message.chat_layout')

@section('title', 'Chat with User')

@section('content')
    <div class="row">
        <div class="col-4 mt-5">
            <h3 align='center' style="color: mediumorchid">{{ ucfirst(auth()->user()->name) }}</h3>
            @forelse ($users as $user)
                <a href="/chat-with/{{ $user->id }}" class="btn btn-outline-primary mt-2"
                    style="width: 100%;">{{ $user->name }}</a> <br>
            @empty
                <h4 style="color: red;">No users</h4>
            @endforelse
        </div>
        <div class="col-8 mt-5" id="newMessage">
            @forelse ($messages as $message)
                <h5><strong style="color: red">
                        {{ $message->sender_id == auth()->user()->id ? 'You' : ucfirst($message->sender->name) }}
                        : </strong>{{ $message->message }}
                </h5>
            @empty
                <h5>No message</h5>
            @endforelse
            <form action="/chat-to/{{ $chatUser->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <input type="text" class="form-control mt-5" name="message" placeholder="Your message...">
                        @error('message')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-4">
                        <input type="file" class="form-control mt-5">
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary mt-5"><i class="bi bi-send"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @if (isset($chatUser))
        <script>
            const chatId = @json($chatUser->id);
            const userId = @json(auth()->user()->name);
        </script>
    @else
        <p>No chat selected</p>
    @endif
@endsection

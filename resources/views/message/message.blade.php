@extends('layouts.main')

@section('content')

    <h1 class="mt-3 mb-3"> Messages</h1>

    <form action="{{ route('message.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-5">
                <input type="text" name="text" class="form-control" placeholder="Text">
            </div>
            <div class="col-5">
                <input type="file" name="image" class="form-control">
            </div>
            <div class="col-2">
                <input class="btn btn-primary" type="submit" name="ok" value="Send">
            </div>
        </div>
    </form>
    <ul id="messageList">
        @forelse ($messages as $message)
            <li>{{ $message->text }}</li>
            <img src="{{ asset($message->image) }}" alt="">
        @empty
            NO record
        @endforelse
    </ul>
@endsection

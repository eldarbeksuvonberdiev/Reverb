@extends('main')

@section('content')
    <a href="{{ route('employee.index') }}" class="mt-5">Employee </a> <br>
    <a href="{{ route('message.index') }}" class="mt-5"> Regular</a>
    <h1 class="mt-3 mb-3"> Employee</h1>
    <form action="{{ route('employee.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-5">
                <input type="text" name="text" class="form-control" placeholder="Text">
            </div>
            <div class="col-2">
                <input class="btn btn-primary" type="submit" name="ok" value="Send">
            </div>
        </div>
    </form>
    <ul id="messageList">
        <table>
            <thead>
                <tr>#</tr>
                <tr>Name</tr>
            </thead>
            <tbody>
                @forelse ($employees as $employee)
                    <tr id="employeeList">
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->name }}</td>
                    </tr>
                @empty
                    NO record
                @endforelse
            </tbody>
        </table>
    </ul>
@endsection

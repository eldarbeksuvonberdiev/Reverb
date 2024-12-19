@extends('layouts.main')

@section('content')
    <h1 class="mt-3 mb-3"> Employee</h1>
    <form action="{{ route('employee.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-5">
                <input type="text" name="name" class="form-control" placeholder="Text">
            </div>
            <div class="col-2">
                <input class="btn btn-primary" type="submit" name="ok" value="Send">
            </div>
        </div>
    </form>
    <table class="table table-striped table-bordered table-hover mt-4 mb-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody id="employeeList">
            @forelse ($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" align="center">
                        NO record
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection

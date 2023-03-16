@extends('layouts.list')

@section('list-content')

<div class="container">
    <div class="row bg-white shadow rounded">
        <div class="row mb-2">
            <div class="col-sm-6 pt-2">
                <h2>Employees List</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">
                                Home
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Employees
                        </li>
                    </ol>
                </nav>
            </div>

            @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
                @php
                    Session::forget('success');
                @endphp
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        </div>
    </div>

    <div class="row justify-content-center mt-2">
        <div class="row py-2 bg-light">
            <div class="col-sm-8 card-header float-right">
                
                <div class="float-right">
                    <form action="{{ route('employees.search') }}" method="GET" class="float-right">
                        @csrf
                        <div class="input-group input-group-sm" style="width: 300px;">
                        <input type="text" name="q" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-sm">
                <a type="button" class="btn btn-primary float-right" href="{{route("employees.create")}}">
                    <i class="fa fa-plus-square" aria-hidden="true"></i> Add New Employee
                </a>
            </div>
            <div class="border rounded table-responsive my-4 p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Gender</th>
                            <th>Hire Date</th>
                            <th>Date of Birth</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if ($employees->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center py-4">No Records found.</td>
                        </tr>
                        @endif

                        @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->id }}</td>
                            <td>{{ $employee->first_name }}</td>
                            <td>{{ $employee->last_name }}</td>
                            <td>
                                {{ ucfirst($employee->gender) }}
                            </td>
                            <td>{{ $employee->hire_date->format('d-m-Y') }}</td>
                            <td>{{ $employee->birth_date->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('employees.show', $employee->id) }}" type="button" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a href="{{ route('employees.edit', $employee->id) }}" type="button" class="btn btn-warning"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                                <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$employee->id}})" data-target="#DeleteModal" class="btn btn-danger">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card-tools">
        <ul class="pagination pagination-sm float-right">
            {!! $employees->links() !!}
        </ul>
    </div>
</div>



@endsection

@extends('layouts.list')

@section('list-content')

<div class="container">
    <div class="row bg-white shadow rounded">
        <div class="row mb-2">
            <div class="col-sm-6 pt-2">
                <h2>Salaries List</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">
                                Home
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Salaries
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-2">
        <div class="row py-2 bg-light">
            <div class="col-sm-8 card-header float-right">
                
                <div class="float-right">
                    <form action="{{ route('salaries.search') }}" method="GET" class="float-right">
                        @csrf
                        <div class="input-group input-group-sm" style="width: 300px;">
                        <input type="text" name="q" class="form-control" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default bg-secondary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="border rounded table-responsive my-4 p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Employee Name</th>
                            <th>Amount</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if ($salaries->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center py-4">No Records found.</td>
                        </tr>
                        @endif

                        @foreach ($salaries as $salary)
                        <tr>
                            <td>{{ $salary->id }}</td>
                            <td>{{ $salary->employee->first_name }} {{ $salary->employee->last_name }}</td>
                            <td>Rs.{{ $salary->amount }}</td>
                            <td>{{ $salary->from_date->format('d-m-Y') }}</td>
                            <td>{{ $salary->to_date ? $salary->to_date->format('d-m-Y') : '' }}</td>
                            <td>
                                <a href="{{ route('employees.show', $salary->employee->id) }}" type="button" class="btn btn-success">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
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
        <ul class="pagination pagination-sm float-end">
            {!! $salaries->links() !!}
        </ul>
    </div>
</div>


@endsection

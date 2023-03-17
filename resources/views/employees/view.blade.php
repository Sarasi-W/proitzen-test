@extends('layouts.list')

@section('list-content')

<div class="container">
    <div class="row bg-white shadow rounded">
        <div class="row mb-2">
            <div class="col-sm-6 pt-2">
                <h2>Employee Details</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">
                                Home
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('employees.index') }}">
                                Employees
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            View
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-2">
        <div class="row py-2 bg-white">
            <h3 class="text-center py-2">Employee Profile</h3>

            <div class="row">
                <h5>Profile Details</h5>

                <div class="row mb-3">
                    <label 
                        class="col-md-3 col-form-label text-md-end">
                        {{ __('Employee Name :') }}
                    </label>

                    <div class="col-md-6">
                        <label 
                            class="col-md-3 col-form-label">
                            {{ $employee->first_name }} {{ $employee->last_name }}
                        </label>
                    </div>
                </div>

                <div class="row mb-3">
                    <label 
                        class="col-md-3 col-form-label text-md-end">
                        {{ __('Date of birth :') }}
                    </label>

                    <div class="col-md-6">
                        <label 
                            class="col-md-3 col-form-label">
                            {{ $employee->birth_date->format('d-m-Y') }}
                        </label>
                    </div>
                </div>

                <div class="row mb-3">
                    <label 
                        class="col-md-3 col-form-label text-md-end">
                        {{ __('Employee Name :') }}
                    </label>

                    <div class="col-md-6">
                        <label 
                            class="col-md-3 col-form-label">
                            {{ ucfirst($employee->gender) }}
                        </label>
                    </div>
                </div>

                <div class="row mb-3">
                    <label 
                        class="col-md-3 col-form-label text-md-end">
                        {{ __('Hire Date :') }}
                    </label>

                    <div class="col-md-6">
                        <label 
                            class="col-md-3 col-form-label">
                            {{ $employee->hire_date->format('d-m-Y') }}
                        </label>
                    </div>
                </div>

                <fieldset class="border border-dark border-2 rounded p-2 my-2">
                    <legend  class="float-none w-auto">Salary Details</legend>
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col center">Amount</th>
                                <th scope="col">From date</th>
                                <th scope="col">To Date</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($employee->salaries->isEmpty())
                                <tr>
                                    <td colspan="4" class="text-center py-4">No Records found.</td>
                                </tr>
                            @else
                            
                                @foreach ($employee->salaries as $salary)
                                    <tr>
                                        <th scope="row">Rs.{{ $salary->amount }}</th>
                                        <td>{{ $salary->from_date->format('d-m-Y') }}</td>
                                        <td>{{ $salary->to_date ? $salary->to_date->format('d-m-Y') : '' }}</td>
                                        <td>{{ $salary->to_date ? $salary->to_date->format('d-m-Y') : '' }}</td>
                                        <td>
                                            <a href="{{ route('salaries.destroy', $salary->id) }}" class="btn btn-danger">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach  
                            @endif  
                        </tbody>
                    </table>
                </fieldset>

                <fieldset class="border border-dark border-2 rounded p-2 my-2">
                    <legend  class="float-none w-auto">Designation Details</legend>
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col center">Title</th>
                                <th scope="col">From date</th>
                                <th scope="col">To Date</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($employee->titles->isEmpty())
                                <tr>
                                    <td colspan="4" class="text-center py-4">No Records found.</td>
                                </tr>
                            @else
                            
                                @foreach ($employee->titles as $title)
                                    <tr>
                                        <th scope="row">{{ $title->designation }}</th>
                                        <td>{{ $title->from_date->format('d-m-Y') }}</td>
                                        <td>{{ $title->to_date ? $title->to_date->format('d-m-Y') : '' }}</td>
                                        <td>
                                            <a href="{{ route('titles.destroy', $title->id) }}" class="btn btn-danger">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach  
                            @endif  
                        </tbody>
                    </table>
                </fieldset>

                <div class="card-footer">
                    <a type="button" href="{{ route('employees.index') }}" class="btn btn-warning float-end mx-2">Go Back</a>
                    <button type="reset" class="btn btn-secondary float-end">Cancel</button>
                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary float-end mx-2">
                        Edit Record
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>

<script>
    $('.alert').alert();
</script>

@endsection

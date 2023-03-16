@extends('layouts.list')

@section('list-content')

<div class="container">
    <div class="row bg-white shadow rounded">
        <div class="row mb-2">
            <div class="col-sm-6 pt-2">
                <h2>{{ Route::currentRouteName() == 'employees.edit' ? 'Edit' : 'Add New' }} Employee</h2>
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
                            {{ Route::currentRouteName() == 'employees.edit' ? 'Edit' : 'Add New' }}
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
        <div class="row py-2 bg-white">
            <h3 class="text-center py-2">Employee Profile</h3>

            <form 
                action="{{ Route::currentRouteName() == 'employees.edit' ? route('employees.update', $employee->id) : route('employees.store') }}" 
                method="post"
                id="submitForm"
            >
                @csrf

                @if(Route::currentRouteName() == 'employees.edit')
                    @method('PUT')

                    <input type="hidden" id="slugSalary" name="slug[]" value="salary">
                    <input type="hidden" id="slugTitle" name="slug[]" value="title">
                    <input type="hidden" id="slugProfile" name="slug[]" value="profile">
                @endif

                <div class="row">
                    <h5>Profile Details</h5>

                    <div class="row mb-3">
                        <label 
                            for="first_name" 
                            class="col-md-3 col-form-label text-md-end">
                            {{ __('First Name :') }}
                        </label>

                        <div class="col-md-6">
                            <input 
                                id="first_name" 
                                type="text" 
                                class="form-control 
                                @error('first_name') is-invalid @enderror" 
                                name="first_name" 
                                value="{{ Route::currentRouteName() == 'employees.edit' ? $employee->first_name : old('first_name') }}" 
                                required 
                                autocomplete="first_name" 
                                autofocus>

                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label 
                            for="last_name" 
                            class="col-md-3 col-form-label text-md-end">
                            {{ __('Last Name :') }}
                        </label>

                        <div class="col-md-6">
                            <input 
                                id="first_name" 
                                type="text" 
                                class="form-control 
                                @error('last_name') is-invalid @enderror" 
                                name="last_name" 
                                value="{{ Route::currentRouteName() == 'employees.edit' ? $employee->last_name : old('last_name') }}" 
                                required 
                                autocomplete="last_name">

                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label 
                            for="date_of_birth" 
                            class="col-md-3 col-form-label text-md-end">
                            {{ __('Date of Birth :') }}
                        </label>

                        <div class="col-md-6">
                            <input 
                                id="date_of_birth" 
                                type="date" 
                                class="form-control 
                                @error('date_of_birth') is-invalid @enderror" 
                                name="date_of_birth" 
                                value="{{ Route::currentRouteName() == 'employees.edit' ? $employee->birth_date->format('Y-m-d') : old('date_of_birth') }}" 
                                required 
                                autocomplete="date_of_birth">

                            @error('date_of_birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label 
                            for="hire_date" 
                            class="col-md-3 col-form-label text-md-end">
                            {{ __('Hire Date :') }}
                        </label>

                        <div class="col-md-6">
                            <input 
                                id="hire_date" 
                                type="date" 
                                class="form-control 
                                @error('hire_date') is-invalid @enderror" 
                                name="hire_date" 
                                value="{{ Route::currentRouteName() == 'employees.edit' ? $employee->hire_date->format('Y-m-d') : old('hire_date') }}" 
                                required 
                                autocomplete="hire_date">

                            @error('hire_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label 
                            for="gender" 
                            class="col-md-3 col-form-label text-md-end">
                            {{ __('Gender :') }}
                        </label>

                        <div class="col-md-6">
                            <select 
                                class="form-select"
                                id="gender"
                                name="gender"
                                value="{{ Route::currentRouteName() == 'employees.edit' ? $employee->gender : old('gender') }}" 
                                aria-label="Gender Selection"
                                required
                                >
                                <option selected disabled>--Choose Gender--</option>
                                <option value="female" {{ isset($employee->gender) && $employee->gender == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="male" {{ isset($employee->gender) && $employee->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="other" {{ isset($employee->gender) && $employee->gender == 'other' ? 'selected' : '' }}>Other</option>
                            </select>

                            @if($errors->first('gender')) 
                                <span class="error invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <h5>
                        Salary Details
                        @if(Route::currentRouteName() == 'employees.edit')
                            <button 
                                type="submit" 
                                class="btn btn-success rounded-circle border border-2 border-dark"
                                onclick="updateSalary()"
                            >
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        @endif
                    </h5>

                    <div class="row mb-3">
                        <div class="col border border-dark border-2 form-section rounded pt-2">

                            @if(Route::currentRouteName() == 'employees.edit' && isset($employee->current_salary))
                                <div class="row">
                                    <div class="col ">
                                        <a 
                                            href="{{ route('salaries.destroy', $employee->current_salary->id) }}" 
                                            class="btn btn-outline-danger float-end"
                                        >
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <div class="row mb-3">
                                <label 
                                    for="amount" 
                                    class="col-md-3 col-form-label text-md-end">
                                    {{ __('Amount :') }}
                                </label>

                                <div class="col-md-6">
                                    <input 
                                        id="amount" 
                                        type="text" 
                                        class="form-control 
                                        @error('amount') is-invalid @enderror" 
                                        name="amount" 
                                        value="{{ Route::currentRouteName() == 'employees.edit' && isset($employee->current_salary->amount) ? $employee->current_salary->amount : old('amount') }}" 
                                        required 
                                        placeholder="$$$"
                                        autocomplete="amount">

                                    @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label 
                                    for="salary_from_date" 
                                    class="col-md-3 col-form-label text-md-end">
                                    {{ __('From Date :') }}
                                </label>

                                <div class="col-md-6">
                                    <input 
                                        id="salary_from_date" 
                                        type="date" 
                                        class="form-control 
                                        @error('salary_from_date') is-invalid @enderror" 
                                        name="salary_from_date" 
                                        value="{{ Route::currentRouteName() == 'employees.edit' && isset($employee->current_salary->from_date) ? $employee->current_salary->from_date->format('Y-m-d') : old('salary_from_date') }}" 
                                        required 
                                        autocomplete="salary_from_date">

                                    @error('salary_from_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label 
                                    for="salary_to_date" 
                                    class="col-md-3 col-form-label text-md-end">
                                    {{ __('To Date :') }}
                                </label>

                                <div class="col-md-6">
                                    <input 
                                        id="salary_to_date" 
                                        type="date" 
                                        class="form-control 
                                        @error('salary_to_date') is-invalid @enderror" 
                                        name="salary_to_date" 
                                        value="{{ Route::currentRouteName() == 'employees.edit' && isset($employee->current_salary->to_date) ? $employee->current_salary->to_date->format('Y-m-d') : old('salary_to_date') }}" 
                                        autocomplete="salary_to_date">

                                    @error('salary_to_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <h5>
                        Designation Details
                        @if(Route::currentRouteName() == 'employees.edit')
                            <button 
                                type="submit" 
                                class="btn btn-success rounded-circle border border-2 border-dark"
                                onclick="updateTitle()"
                            >
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        @endif
                    </h5>

                    <div class="row mb-3">
                        <div class="col border border-dark border-2 form-section rounded pt-2">

                             @if(Route::currentRouteName() == 'employees.edit' && isset($employee->current_title))
                                <div class="row">
                                    <div class="col ">
                                        <a 
                                            href="{{ route('titles.destroy', $employee->current_title->id) }}" 
                                            class="btn btn-outline-danger float-end"
                                        >
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <div class="row mb-3">
                                <label 
                                    for="title" 
                                    class="col-md-3 col-form-label text-md-end">
                                    {{ __('Title :') }}
                                </label>

                                <div class="col-md-6">
                                    <input 
                                        id="title" 
                                        type="text" 
                                        class="form-control 
                                        @error('title') is-invalid @enderror" 
                                        name="title" 
                                        value="{{ Route::currentRouteName() == 'employees.edit' && isset($employee->current_title->designation) ? $employee->current_title->designation : old('title') }}" 
                                        required 
                                        placeholder="Title"
                                        autocomplete="title">

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label 
                                    for="title_from_date" 
                                    class="col-md-3 col-form-label text-md-end">
                                    {{ __('From Date :') }}
                                </label>

                                <div class="col-md-6">
                                    <input 
                                        id="title_from_date" 
                                        type="date" 
                                        class="form-control 
                                        @error('title_from_date') is-invalid @enderror" 
                                        name="title_from_date" 
                                        value="{{ Route::currentRouteName() == 'employees.edit' && isset($employee->current_title->from_date) ? $employee->current_title->from_date->format('Y-m-d') : old('title_from_date') }}" 
                                        required 
                                        autocomplete="title_from_date">

                                    @error('title_from_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label 
                                    for="title_to_date" 
                                    class="col-md-3 col-form-label text-md-end">
                                    {{ __('To Date :') }}
                                </label>

                                <div class="col-md-6">
                                    <input 
                                        id="title_to_date" 
                                        type="date" 
                                        class="form-control 
                                        @error('title_to_date') is-invalid @enderror" 
                                        name="title_to_date" 
                                        value="{{ Route::currentRouteName() == 'employees.edit' && isset($employee->current_title->to_date) ? $employee->current_title->to_date->format('Y-m-d') : old('title_to_date') }}" 
                                        autocomplete="title_to_date">

                                    @error('title_to_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-end mx-2">
                            {{ Route::currentRouteName() == 'employees.edit' ? 'Update' : 'Submit' }}
                        </button>
                        <button type="reset" class="btn btn-secondary float-end">Cancel</button>
                        <a type="button" href="{{ route('employees.index') }}" class="btn btn-warning float-end mx-2">Go Back</a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('.alert').alert();
</script>

<script>
    function updateTitle() {
        document.getElementById('slugSalary').value = null;
        document.getElementById('slugProfile').value = null;
        document.getElementById('slugTitle').value = 'title';
    }

    function updateSalary() {
        document.getElementById('slugTitle').value = null;
        document.getElementById('slugProfile').value = null;
        document.getElementById('slugSalary').value = 'salary';
    }
</script>

@endsection

@extends('layouts.app')

@section('content')


<div class="grid-container-element w-100">
    <div class="shadow">
        <ul id="side-navigation">
            <li><a class="active" href="#home">Home</a></li>
            <li><a href="#">Employees</a></li>
            <li><a href="#">Salaries</a></li>
            <li><a href="#">Titles</a></li>
        </ul>
    </div>
    <div class="shadow-none">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Dashboard') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            {{ __('You are logged in!') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

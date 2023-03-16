@extends('layouts.app')

@section('content')
<x-side-navigation />

<div class="grid-container-element w-100">

    <x-side-navigation />
    
    <div class="shadow-none">
        @yield('list-content')
    </div>
</div>
@endsection
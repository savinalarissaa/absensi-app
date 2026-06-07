@extends('layout')

@section('title', 'Home')

@section('content')
<div class="container mt-5">

    <div class="d-flex gap-2">

        <a href="{{ route('logout') }}"
           class="btn btn-danger">
            Logout
        </a>

    </div>

</div>
@endsection
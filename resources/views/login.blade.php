@extends('layouts.base')
@section('content')
    <form action="{{ route('login.user') }}" method="POST" class="form-control w-75 border-dark m-5">

        @include('registration.components.account')

        <button type="submit" class="btn btn-primary w-100 mt-2">Login</button>

        @csrf

    </form>
@endsection

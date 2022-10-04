@extends('layouts.base')
@section('content')
<form action="{{ route('login.user') }}" method="POST" class="form-control w-75 border-dark m-5">

    <div class="form-control border-0">
        <label for="email">Email</label>
        <input type="text" name='email' class="form-control">
    </div>
    <div class="form-control border-0">
        <label for="password">Password</label>
        <input type="password" name='password' class="form-control">
    </div>

    <div class="form-control border-0">
        <button type="submit" class="btn btn-primary w-100">Submit</button>
    </div>

    @csrf

</form>

@endsection

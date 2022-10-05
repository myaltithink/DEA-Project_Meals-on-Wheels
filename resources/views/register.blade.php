@extends('layouts.base')
@section('content')
<h3>Register</h3>

<p>Register As</p>

<div id='registration-type'>
    <button type="button" class="btn">Member</button>
    <button type="button" class="btn">Caregiver</button>
    <button type="button" class="btn">Partner</button>
    <button type="button" class="btn" style="border-right: solid 1px gray">Volunteer</button>
</div>
<form action="{{ route('register.member') }}" method="POST" class="form-control w-75 border-dark m-5">

    <div class="form-control border-0">
        <label for="first-name">First Name</label>
        <input type="text" name='first_name' class="form-control">
    </div>

    <div class="form-control border-0">
        <label for="last-name">Last Name</label>
        <input type="text" name='last_name' class="form-control">
    </div>
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
    @yield('registration-form')
@endsection

@extends('register')
@section('login-content')
    <div id="verification-container">
        <div id="container-child" class="col-10 col-md-9">
            <form action="{{ route('login.user') }}" method="POST" class="">

                <h4>Login</h4>

                <p>Start using MerryMeal's Meal on Wheels application by signing in</p>

                <p>Doesn't have an account yet? <a href="{{ route('registration.member') }}">Register</a></p>

                @include('registration.components.account')

                <a href="{{ route('forgot_password') }}">Forgot Password?</a>
                <button type="submit" class="btn btn-primary w-100 mt-2">Login</button>

                @csrf

            </form>
        </div>
    </div>
@endsection

@push('styles')
    @vite(['resources/css/non-registration-style.css'])
@endpush

@extends('register')
@section('forgot-pass-content')
    <div id="verification-container">
        <div class="m-5">
            <h3>Forgot Your Password?</h3>
            <p>Enter the email address of your account to verify your password reset</p>
            <form action="{{ route('create.forgot.pass') }}" method="POST">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control mb-0">
                <small class="error-message">{{ @session('email_error') }}</small>
                <button type="submit" class="btn btn-primary w-100 mt-2">Submit</button>
                @csrf
            </form>
        </div>
    </div>
@endsection

@push('styles')
    @vite(['resources/css/non-registration-style.css'])
@endpush

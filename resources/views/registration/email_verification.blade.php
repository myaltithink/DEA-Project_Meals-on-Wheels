@extends('register')
@section('verification-content')
    <div id="verification-container">
        <div class="m-5">
            <h3>Email Verification</h3>
            <p>We've sent a email verification code to the email address you provided</p>
            <p>Did not received any? <a href="">Resend</a></p>
            <form action="" action="POST">
                <label for="verification-code">Verification Code</label>
                <input type="text" name="verification-code" class="form-control">
                <input type="hidden" name="email" value="{{ session('email') }}">
                <button type="submit" class="btn btn-primary w-100">Verify</button>
                @csrf
            </form>
        </div>
    </div>
@endsection

@push('styles')
    @vite(['resources/css/non-registration-style.css'])
@endpush

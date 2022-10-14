@extends('register')
@section('verification-content')
    <div id="verification-container">
        <div class="m-5">
            <h3>Email Verification</h3>
            <p>We've sent a email verification code to the email address you provided</p>
            <p>Did not received any? <a href="">Resend</a></p>
            <form
                action="
                @if (session('caller') == 'registration') {{ route('verify.register') }}
                @elseif (session('caller') == 'forgot-pass')
                    {{ route('verify.forgot_pass') }} @endif
            "
                method="POST">
                <label for="verification-code">Verification Code</label>
                <input type="text" name="verification-code" class="form-control mb-0">
                <small class="error-message">{{ session('verification_error') }}</small>
                <input type="hidden" name="email" value="{{ session('email') }}">
                <button type="submit" class="btn btn-primary w-100 mt-3">Verify</button>
                @csrf
            </form>
        </div>
    </div>
@endsection

@push('styles')
    @vite(['resources/css/non-registration-style.css'])
@endpush

@extends('register')
@section('success-content')
    <div id="message-container">
        <div class="m-5">
            <div class="d-flex d-md-none justify-content-center">
                <img src="{{ Vite::asset('resources/images/check-mark.jpg') }}" alt="check mark" height="250">
            </div>
            @if (Request::is('registered'))
                <h3>Registered Successfully</h3>
                <p>Your registration request has been submitted, it will now enter the validation proccess.</p>

                <p>We will send a message to the email address you've provided to the accound section to notify you
                    whether
                    your registration has been approved or rejected.</p>

                <p>if your registration has been rejected, we will also include the reason of rejection on the message</p>
                <a href="/">
                    <button type="button" class="btn btn-primary w-100">
                        Home
                    </button>
                </a>
            @elseif (Request::is('password-changed'))
                <h3>Password Changed</h3>
                <p>Your password has been updated successfully you may now login with your new password</p>
                <a href="/login">
                    <button type="button" class="btn btn-primary w-100">
                        Login
                    </button>
                </a>
            @endif

        </div>
    </div>
@endsection

@push('styles')
    @vite(['resources/css/non-registration-style.css'])
@endpush

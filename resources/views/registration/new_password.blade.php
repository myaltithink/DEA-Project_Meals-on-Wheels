@extends('register')
@section('new-pass-content')
    <div id="verification-container">
        <div id="container-child" class="col-10 col-md-9">
            <h3>Password Reset</h3>
            <form action="" action="POST" id="new-password-form">
                <div class="mb-2">
                    <label for="password">New Password</label>
                    <div class="pass-input d-flex form-control p-0 mb-0">
                        <input type="password" name="password" id="password" class="form-control border-0 mb-0" />
                        <button type="button" class="btn show-pass"><i
                                class="pass-state-icon fa fa-eye-slash"></i></button>
                    </div>
                    <small class="error-message"></small>
                </div>

                <div class="mb-3">
                    <label for="confirm-pass">Confirm Password</label>
                    <div class="pass-input d-flex form-control p-0 mb-0">
                        <input type="password" name="confirm-pass" id="confirm-pass" class="form-control border-0 mb-0" />
                        <button type="button" class="btn show-pass"><i
                                class="pass-state-icon fa fa-eye-slash"></i></button>
                    </div>
                    <small class="error-message"></small>
                </div>
                <button type="submit" id="submit-new-pass" class="btn btn-primary w-100 disabled">Submit</button>
                @csrf
            </form>
        </div>
    </div>
@endsection

@push('styles')
    @vite(['resources/css/non-registration-style.css', 'resources/js/login-registration.js'])
@endpush

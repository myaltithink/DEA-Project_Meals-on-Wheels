@extends('layouts.base')
@section('content')
    <div id="registration-container">
        <div class="form-group">
            <h3>Register</h3>

            <p>Register As</p>

            <div id='registration-type'>
                <a href="/register-member">
                    <button type="button" class="btn @if (Request::is('register-member')) current-registration @endif">
                        Member
                    </button>
                </a>
                <a href="/register-caregiver">
                    <button type="button" class="btn @if (Request::is('register-caregiver')) current-registration @endif">
                        Caregiver
                    </button>
                </a>
                <a href="/register-partner">
                    <button type="button" class="btn @if (Request::is('register-partner')) current-registration @endif">
                        Partner
                    </button>
                </a>
                <a href="/register-volunteer">
                    <button type="button" class="btn @if (Request::is('register-volunteer')) current-registration @endif">
                        Volunteer
                    </button>
                </a>
            </div>

        </div>

        <div id="form-content">
            <form
                action="
        @if (Request::is('register-member')) {{ route('register.member') }}
            @elseif (Request::is('register-caregiver'))
            {{ route('register.caregiver') }}
            @elseif (Request::is('registration-partner'))
            {{ route('register.partner') }}
            @elseif (Request::is('registration-volunteer'))
            {{ route('register.volunteer') }} @endif
        "
                method="POST" class="form-group" enctype="multipart/form-data">

                <input class="form-control w-100" name="file_input" type="file"
                    accept="image/png, image/gif, image/jpeg" />
                @yield('registration-form')
                <div class="form-control border-0">
                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                </div>
                @csrf
            </form>
        </div>
    </div>
@endsection

@push('styles')
    @vite(['resources/css/registration-style.css'])
@endpush

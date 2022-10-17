@extends('layouts.base')
@section('content')
    <div id="registration-container" class="d-block d-md-flex">
        <div id="form-container">
            @if (str_contains(url()->current(), 'register-'))
                <div id="registration-head" class="form-group form-borders left-padding pt-4" style="border-bottom-width: 5px">
                    <div>
                        <h3>Register</h3>
                        <p>Already have an Account? <a href="/login">Sign In</a></p>
                        <p class="m-0">Register As</p>
                        <div id='registration-type'>
                            <a href="/register-member">
                                <button type="button"
                                    class="btn @if (Request::is('register-member')) current-registration @endif">
                                    Member
                                </button>
                            </a>
                            <a href="/register-caregiver">
                                <button type="button"
                                    class="btn @if (Request::is('register-caregiver')) current-registration @endif">
                                    Caregiver
                                </button>
                            </a>
                            <a href="/register-partner">
                                <button type="button"
                                    class="btn @if (Request::is('register-partner')) current-registration @endif">
                                    Partner
                                </button>
                            </a>
                            <a href="/register-volunteer">
                                <button type="button"
                                    class="btn @if (Request::is('register-volunteer')) current-registration @endif">
                                    Volunteer
                                </button>
                            </a>
                        </div>

                        <p id="registration-desc">
                            @if (Request::is('register-member'))
                                Member registration is for people who are in need of the service of Meals on Wheels
                            @elseif (Request::is('register-caregiver'))
                                Caregiver registration is for people who are open to take care of the registered Members
                                <br> <br>
                                Caregiver can also be the one taking care of their relatives who signed up as a Member
                            @elseif (Request::is('register-partner'))
                                Partner is for organization or companies who are willing to lend a hand to cook the meals to
                                expand
                                the
                                reach of Meals on Wheels
                            @elseif (Request::is('register-volunteer'))
                                Volunteer is for people who are willing to lend a hand to MerryMeals as an individual, they
                                can
                                become a
                                Caregiver of an unassigned Member and they can also be the Delivery Person of the prepared
                                meal
                            @endif
                        </p>
                    </div>

                    <small class="error-message mb-2">
                        @if ($errors->any())
                            <p class="error-message mb-0">Registration Failed</p>
                            <ul class="mb-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <p class="error-message">Please fill out the <a href="#identity-section">Identity</a> and
                                <a href="#account-section">Account</a> section again as these sections does not retain the
                                submitted information due to sensitivity of the information
                            </p>
                        @endif
                    </small>
                </div>
            @endif
            <div id="form-content" class="form-borders border-bottom-0 pb-4">
                @if (Request::is('email-verification'))
                    @yield('verification-content')
                @elseif(str_contains(url()->current(), 'register-'))
                    @include('registration.registration_form')
                @elseif (Request::is('registered') || Request::is('password-changed'))
                    @yield('success-content')
                @elseif (Request::is('forgot-password'))
                    @yield('forgot-pass-content')
                @elseif (Request::is('new-password'))
                    @yield('new-pass-content')
                @elseif (Request::is('login'))
                    @yield('login-content')
                @endif
            </div>

        </div>

        <div class="img-container img-background registration-img d-none d-md-block"
            style="

            @if (Request::is('register-member')) background-image: url('{{ Vite::asset('resources/images/member-registration-img.jpg') }}')
            @elseif (Request::is('register-caregiver'))
                background-image: url('{{ Vite::asset('resources/images/caregiver-registration-img.jpg') }}')
            @elseif (Request::is('register-partner'))
                background-image: url('{{ Vite::asset('resources/images/partner-registration-img.jpg') }}')
            @elseif (Request::is('register-volunteer'))
                background-image: url('{{ Vite::asset('resources/images/volunteer-registration-img.jpg') }}')
            @elseif (Request::is('email-verification'))
                background-image: url('{{ Vite::asset('resources/images/email-verification.jpg') }}')
            @elseif (Request::is('registered') || Request::is('password-changed'))
                background-image: url('{{ Vite::asset('resources/images/action-complete.jpg') }}')
            @elseif (Request::is('forgot-password') || Request::is('new-password'))
                background-image: url('{{ Vite::asset('resources/images/forgot-pass.jpg') }}')
            @elseif (Request::is('login'))
                background-image: url('{{ Vite::asset('resources/images/login-banner.jpg') }}') @endif

                ">
        </div>
    </div>
@endsection

@push('styles')
    @vite(['resources/css/registration-style.css'])
@endpush

@extends('layouts.base')
@section('content')
    <div id="registration-container" class="d-block d-md-flex">
        <div id="form-container">
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
                            Volunteer is for people who are willing to lend a hand to MerryMeals as an individual, they can
                            become a
                            Caregiver of an unassigned Member and they can also be the Delivery Person of the prepared meal
                        @endif
                    </p>
                </div>
            </div>
            <div id="form-content" class="form-borders border-bottom-0 pb-4">
                <form
                    action="
            @if (Request::is('register-member')) {{ route('register.member') }}
            @elseif (Request::is('register-caregiver'))
            {{ route('register.caregiver') }}
            @elseif (Request::is('register-partner'))
            {{ route('register.partner') }}
            @elseif (Request::is('register-volunteer'))
            {{ route('register.volunteer') }} @endif
        "
                    method="POST" class="form-group" enctype="multipart/form-data">

                    @yield('registration-form')
                    <div class="left-padding">
                        <div class="">
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </div>
                    </div>
                    @csrf
                </form>
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
                background-image: url('{{ Vite::asset('resources/images/volunteer-registration-img.jpg') }}') @endif

                ">
        </div>
    </div>
@endsection

@push('styles')
    @vite(['resources/css/registration-style.css'])
@endpush

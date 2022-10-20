@extends('layouts.userassessment')
@section('subcontent')
    
    <div class="mt-5 text-center">
        <div class="col-lg-12">
        <h2 class="display-12 fw-bold">Pending Users</h2>
        </div>
    </div>

    {{--tabs here--}}
    <div class="w-100">
        <div class="card border border-0 bg-transparent mx-5 my-4">
            <div class = "card-header bg-transparent border border-0 p-0 m-0">
                <nav>
                    <ul class="nav nav-tabs border border-0">
                        <li class="nav-item">
                            <a class="
                                nav-link
                                @if (Request::url() == route('member-assessment'))
                                    active
                                @endif"
                                href="{{route('member-assessment')}}"
                            >
                                Member
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="
                                nav-link
                                @if (Request::url() == route('caregiver-assessment'))
                                active
                                @endif"
                                href="{{route('caregiver-assessment')}}"
                            >
                                Caregiver
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="
                                nav-link
                                @if (Request::url() == route('partner-assessment'))
                                active
                                @endif"
                                href="{{route('partner-assessment')}}"
                            >
                                Partner
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="
                                nav-link
                                @if (Request::url() == route('volunteer-assessment'))
                                active
                                @endif"
                                href="{{route('volunteer-assessment')}}"
                            >
                                Volunteer
                            </a>
                        </li>
                      </ul>
                </nav>
            </div>
            <div class="card-body border border-dark  rounded-3 overflow-auto position-relative" style="height: 50rem; overflow-x:hidden;">
                @yield('main')
            </div>
            {{-- <div class = "card-footer bg-transparent border border-1 border-top-0">
                @yield('paginations')
            </div> --}}
        </div>
    </div>
@endsection
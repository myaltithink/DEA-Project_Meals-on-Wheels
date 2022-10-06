@extends('layouts.mealproposals')
@section('subcontent')

    {{--tabs here--}}
    <div style="width: 100vw; z-index:-1;">
        <div class="card border border-0 bg-transparent mx-5 my-4">
            <div class = "card-header bg-transparent border border-0 p-0 m-0">
                <nav>
                    <ul class="nav nav-tabs border border-0">
                        <li class="nav-item">
                            <a class="
                                nav-link
                                @if (Request::url() == route('my-proposal-list'))
                                    active
                                @endif"
                                href="{{route('my-proposal-list')}}">
                                    Proposed Meals
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="
                                nav-link
                                @if (Request::url() == route('add-meal-proposal'))
                                active
                                @endif"
                                href="{{route('add-meal-proposal')}}">
                                    New Meal
                            </a>
                        </li>
                      </ul>
                </nav>
            </div>
            <div class="card-body border border-bottom-0 border-1 rounded-1" style="height: 50rem">
                @yield('main')
            </div>
            <div class = "card-footer bg-transparent border border-1 border-top-0">
                @yield('paginations')
            </div>
        </div>
    </div>
@endsection

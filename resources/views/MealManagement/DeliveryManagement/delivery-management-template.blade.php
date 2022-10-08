@extends('layouts.orderbase')
@section('subcontent')

    <div class="w-100">
        <div class="card border border-0 bg-transparent mx-5 my-4">
            <div class = "card-header bg-transparent border border-0 p-0 m-0">
                @include('MealManagement.DeliveryManagement.navigations')
            </div>
            <div class="card-body border border-bottom-0 border-1 rounded-1 overflow-auto position-relative p-4" style="height: 50rem; overflow-x:hidden;">
                @yield('main')
            </div>
            <div class = "card-footer bg-transparent border border-1 border-top-0">
                @yield('paginations')
            </div>
        </div>
    </div>
@endsection

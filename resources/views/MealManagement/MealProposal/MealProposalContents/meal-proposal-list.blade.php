@extends('MealManagement.MealProposal.meal-proposal-template')
@section('main')
    <div class ="row p-3 gy-4">
        <div class = "card col-12">
            <div class = "card-header border-0 bg-transparent">
                <div class ="d-flex flex-fill justify-content-lg-end justify-content-center">
                    <div class = "d-flex">
                        <span class="mx-2">
                            <strong>Created at:</strong>
                            <span class = "ms-2">2022-10-05 07:19:41</span>
                        </span>
                        <span class="mx-2">
                            <strong>Modified at:</strong>
                            <span class = "ms-2">2022-10-05 07:19:41</span>
                        </span>
                    </div>
                </div>
            </div>
            <div class ="card-body row">
                <div class = "col-12 col-lg-2 d-flex justify-content-lg-start justify-content-center">
                    <div style="height: 10rem; width:10rem;">
                        <img src = "{{Vite::asset('resources/images/logo.png')}}" class="h-100 w-100"/>
                    </div>
                </div>
                <div class="col-lg-10 col-12 row gy-0">
                    <div class ="col-12">
                        <h1>Meal Name</h1>
                    </div>
                    <div class ="col-12 d-flex">
                        <strong>Status: </strong>
                        <span class="ms-2">Pending</span>
                    </div>
                    <div class ="col-12 d-flex flex-column">
                        <strong>Reason For Rejection: </strong>
                        <p>
                            Tite
                        </p>
                    </div>
                </div>

            </div>
            <div class = "card-footer bg-transparent border-0">
                <div class = "d-flex justify-content-end">
                    <a href="" class="btn btn-primary mx-1">
                        View Meal Plan
                    </a>
                    <a href="{{route('edit-meal-proposal')}}" class="btn btn-outline-primary mx-1">
                        Edit Meal Plan
                    </a>
                    <a href = "" class = "btn btn-danger mx-1">
                        Delete Meal Plan
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('paginations')
    {{--the pagination thingy goes here--}}
@endsection

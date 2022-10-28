@extends('MealManagement.MealProposal.meal-proposal-template')
@section('main')
    @if(session('success'))
        <div class = "alert alert-success">
            {{session('success')}}
        </div>
    @endif
    <div class ="row p-3 gy-4">
        @forelse ($plans as $plan)
            <div class = "card col-12">
                <div class = "card-header border-0 bg-transparent">
                    <div class ="d-flex flex-fill justify-content-lg-end justify-content-center">
                        <div class = "d-flex">
                            <span class="mx-2">
                                <strong>Created at:</strong>
                                <span class = "ms-2">{{ $plan->created_at->diffForHumans() }}</span>
                            </span>
                            <span class="mx-2">
                                <strong>Modified at:</strong>
                                <span class = "ms-2">{{ $plan->updated_at->diffForHumans() }}</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class ="card-body row">
                    <div class = "col-12 col-lg-2 d-flex justify-content-lg-start justify-content-center">
                        <div style="height: 15rem; width:15rem;" class="overflow-hidden border border-1 rounded-2">
                            <img src = "{{ asset('storage/foods/'.$plan->meal_image_path) }}" class="w-100 h-100" alt = "{{$plan->meal_name}}" loading="lazy"/>
                        </div>
                    </div>
                    <div class="col-lg-10 col-12 row gy-0">
                        <div class ="col-12">
                            <h1>{{ $plan->meal_name }}</h1>
                        </div>
                        <div class ="col-12 d-flex">
                            <strong>Status: </strong>
                            <span class="ms-2">{{ $plan->status }}</span>
                        </div>
                        @if ($plan->reason_for_rejection != null)
                            <div class ="col-12 d-flex flex-column">
                                <strong>Reason For Rejection: </strong>
                                <p>
                                    {{ $plan->reason_for_rejection }}
                                </p>
                            </div>
                        @endif
                    </div>

                </div>
                <div class = "card-footer bg-transparent border-0">
                    <div class = "d-flex justify-content-end">
                        <a href="{{ route('view-meal-proposal', $plan) }}" class="btn btn-primary mx-1">
                            View Meal Plan
                        </a>
                        <a href="{{ route('edit-meal-proposal', $plan) }}" class="btn btn-outline-primary mx-1">
                            Edit Meal Plan
                        </a>
                        <form method="POST" action ="{{ route('delete-meal', $plan) }}">
                            @csrf
                            @method('DELETE')
                            <button class = "btn btn-danger mx-1">
                                @method("delete")
                                Delete Meal Plan
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            @empty
            <div class = "position-absolute start-50 top-50 translate-middle">
                <div class = "d-flex align-items-center justify-content-center">
                    <h1 class ="display-1 text-muted">
                        No Proposed Meals Yet
                    </h1>
                </div>
            </div>

        @endforelse
    </div>
@endsection
@section('paginations')
    {{ $plans->links() }}
@endsection

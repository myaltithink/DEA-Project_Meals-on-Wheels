@extends('MealManagement.DeliveryManagement.delivery-management-template')
@section('main')
    <div class="row g-4">

        @forelse ($plans as $plan)
            {{-- do a for loop here later --}}
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="card" style="height:20rem;">
                    <div class="card-header overflow-hidden p-0 bg-transparent" style="height: 10rem;">
                        <img src="{{ asset('storage/foods/' . $plan->meal_image_path) }}" class="card-img-top" />
                    </div>
                    <div class="card-body">
                        <span class="text-center text-uppercase h3 d-block">{{ $plan->meal_name }}</span>
                    </div>
                    <div class="card-footer bg-transparent border border-0 p-2">
                        @HasAnyRole(['ROLE_MEMBER', 'ROLE_CAREGIVER'])
                            @IsAvailable(strtotime(date('h:i A', time())))
                                <button class="btn btn-primary w-100 meal-select-prompt" data-bs-toggle="modal"
                                    data-bs-target="#meal-select-confirmation" data-meal-value="{{ $plan->meal_plan_id }}"
                                    @if ($hasOrdered == true) disabled @endif>
                                    @if ($hasOrdered != null)
                                        @if ($hasOrdered == true)
                                            Ordered
                                        @endif
                                    @else
                                        Order
                                    @endif
                                </button>
                            @ElseIsAvailable
                                <button class="btn btn-primary w-100 text-uppercase" disabled>
                                    Service unavailable
                                </button>
                            @EndIsAvailable
                            @EndHasAnyRoles
                            @ExcludeRole(['ROLE_MEMBER', 'ROLE_CAREGIVER'])
                                <button class="btn btn-outline-success w-100" @disabled(true)>
                                    Approved Meal Plan
                                </button>
                            @EndExcludeRole
                        </div>
                    </div>
                </div>
                @empty
                    <div class="position-absolute start-50 top-50 translate-middle">
                        <div class="d-flex align-items-center justify-content-center">
                            <h1 class="display-1 text-muted">
                                No Available Meals Yet
                            </h1>
                        </div>
                    </div>
                @endforelse
            </div>
        @endsection
        @section('modals')
            @include('MealManagement.DeliveryManagement.utils.meal-select-prompt')
            @push('scripts')
                @vite(['resources/js/delivery-management-prompt.js'])
            @endpush
        @endsection

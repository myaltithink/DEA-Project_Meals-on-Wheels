<div class='border border-1 px-5 py-3'>
    <h3>Welcome to Meals on Wheels,
        {{ Auth::user()->member_details->profile->first_name . ' ' . Auth::user()->member_details->profile->last_name }}
    </h3>
    @IsAvailable(strtotime(date('h:i A', time())))
        <p>
            Hope we can serve you once again with our food delivery service.
        </p>
        <p>
            In hopes you at least ease some burden out of your shoulders.
        </p>
        <p>
            Below are some of the available foods that you can order.
        </p>
        <p>
            Do note that Meals on Wheels services are only available from
            <strong>10AM to 4PM.</strong>
        </p>
    @ElseIsAvailable
        <p>
            Sorry it seems like you have visited the website beyond or before our operating hours
        </p>
        <p>
            You may consider visiting us again tomorrow.
        </p>
    @EndIsAvailable

</div>
<div class="container border border-1 border-start-0 border-end-0 p-3 position-relative" style="min-height: 30rem;">
    @IsAvailable(strtotime(date('h:i A', time())))
        <div class="row g-4">
            <div class="d-flex justify-content-center">
                <h1>Available Meals</h1>
            </div>
            @forelse ($plans as $plan)
                {{-- do a for loop here later --}}
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="card shadow-lg" style="height:20rem;">
                        <div class="card-header overflow-hidden p-0 bg-transparent" style="height: 10rem;">
                            <img src="{{ asset('storage/foods/' . $plan->meal_image_path) }}" class="card-img-top"
                                alt="{{ $plan->meal_name }}" loading="lazy" />
                        </div>
                        <div class="card-body">
                            <span class="text-center text-uppercase h3 d-block">{{ $plan->meal_name }}</span>
                        </div>
                        <div class="card-footer bg-transparent border border-0 p-2">
                            @HasAnyRole(['ROLE_MEMBER', 'ROLE_CAREGIVER'])
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
                                <small class="text-center d-block">
                                    @if ($hasOrdered)
                                        You may only order once a day
                                    @endif
                                </small>
                                @EndHasAnyRoles

                            </div>
                        </div>
                    </div>
                    @empty
                        <div>
                            <div class="d-flex align-items-center justify-content-center">
                                <h1 class="display-1 text-muted">
                                    No Available Meals Yet
                                </h1>
                            </div>
                        </div>
                    @endforelse
                </div>
                <div class="row justify-content-center mt-5">
                    <a href="{{ route('meals-list') }}" class="text-center d-block w-100 link-info">View All Available Meals</a>
                </div>
            @ElseIsAvailable
                <h1 class="text-center">Available Meals</h1>
                <div style="height: 30vh" class="d-flex align-items-center justify-content-center">
                    <div>
                        <div class="d-flex align-items-center justify-content-center flex-column">
                            <h1 class="display-1 text-muted d-block text-center">
                                Service is unavailable
                            </h1>
                            <span class="text-center">
                                Meals on Wheels Service is only available from <strong>10AM - 4PM</strong>
                            </span>
                        </div>
                    </div>
                </div>
            @EndIsAvailable
        </div>


        @include('MealManagement.DeliveryManagement.utils.meal-select-prompt')
        @push('scripts')
            @vite(['resources/js/delivery-management-prompt.js'])
        @endpush

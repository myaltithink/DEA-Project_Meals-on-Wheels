<div class = "border border-1 px-3 py-3" style="min-height: 10rem;">
    <h3>Welcome to Meals on Wheels, {{Auth::user()->volunteer_details->organization_name}}!</h3>

    <p>Thank you {{Auth::user()->volunteer_details->organization_name}} for your support to MerryMeals by helping us with our service.</p>
</div>
<div class = "border border-1 px-5 py-3" style="min-height: 30rem;">
    <span class="fw-bold">Orders to be delivered <a href = "{{route('rp-del-orders')}}" class = "ms-3 text-info fw-normal">View all orders</a></span>
    <div class = "my-4">
        <div class="accordion" id="orders">
            @foreach ($plans as $key => $plan)
                @if ($key == 0)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="{{ $plan->mealPlan->meal_name.$key }}">
                      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{ str_replace(' ', '_', $plan->mealPlan->meal_name) }}">
                        Order Details
                      </button>
                    </h2>
                    <div id="{{ str_replace(' ', '_', $plan->mealPlan->meal_name) }}" class="accordion-collapse collapse show" data-bs-parent="#orders">
                      <div class="accordion-body">
                        <div class = "card col-12 px-2 pb-3">
                            <div class = "card-header border-0 bg-transparent">
                                <div class ="d-flex flex-fill justify-content-lg-end justify-content-center">
                                    <div class = "d-flex">
                                        <span class="mx-2">
                                            <strong>Ordered at:</strong>
                                            <span class = "ms-2">{{ date_format(date_create($plan->meal_order_ordered_at), 'Y/m/d') }}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class ="card-body row">
                                <div class = "col-12 col-lg-2 col-md-4 d-flex justify-content-lg-start justify-content-center">
                                    <div style="height: 15rem; width:15rem;" class="overflow-hidden border border-1 rounded-2">
                                        <img src = "{{ asset('storage/foods/'.$plan->mealPlan->meal_image_path) }}" class="w-100 h-100"/>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-12 col-md-8 row gy-0">
                                    <div class ="col-12">
                                        <h1>{{ $plan->mealPlan->meal_name }}</h1>
                                    </div>
                                    <div class ="col-12 d-flex">
                                        <strong>Prepared By: </strong>
                                        <span class="ms-2">{{ $plan->prepared_by }}</span>
                                    </div>
                                    <div class ="col-12 d-flex">
                                        <strong>Delivered By: </strong>
                                        <span class="ms-2">{{ $plan->delivered_by }}</span>
                                    </div>
                                    <div class ="col-12 d-flex">
                                        <strong>Status: </strong>
                                        <span class="ms-2">{{ $plan->meal_order_status }}</span>
                                    </div>
                                    <div class ="col-12 d-flex">
                                        <strong>Meal Type: </strong>
                                        <span class="ms-2">{{ $plan->meal_order_type }}</span>
                                    </div>

                                    @role('ROLE_VOLUNTEER_RIDER')
                                        <div class ="col-12 d-flex">
                                            <strong>Meal Address: </strong>
                                            <span class="ms-2">{{ $plan->prepared_by_address }}</span>
                                        </div>
                                    @endrole

                                    <div class ="col-12 d-flex">
                                        <strong>Address To Deliver: </strong>
                                        <span class="ms-2">
                                            {{ $plan->ordered_by_address }}
                                        </span>
                                    </div>


                                </div>

                            </div>
                            <div class = "card-footer bg-transparent border-0 d-flex justify-content-end">
                                <form method="POST" action="{{ route('delivered', $plan) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class ="btn btn-outline-primary px-5 py-2">
                                        Delivered
                                    </button>
                                </form>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endif
                @if ($key > 0)
                    <div class="accordion-item">
                    <h2 class="accordion-header" id="{{ $plan->mealPlan->meal_name.$key }}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"  data-bs-target="#{{ str_replace(' ', '_', $plan->mealPlan->meal_name) }}">
                        Order Details
                        </button>
                    </h2>
                    <div id="{{ str_replace(' ', '_', $plan->mealPlan->meal_name) }}"  class="accordion-collapse collapse show" data-bs-parent="#orders">
                        <div class="accordion-body">
                            <div class = "card col-12 px-2 pb-3">
                                <div class = "card-header border-0 bg-transparent">
                                    <div class ="d-flex flex-fill justify-content-lg-end justify-content-center">
                                        <div class = "d-flex">
                                            <span class="mx-2">
                                                <strong>Ordered at:</strong>
                                                <span class = "ms-2">{{ date_format(date_create($plan->meal_order_ordered_at), 'Y/m/d') }}</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class ="card-body row">
                                    <div class = "col-12 col-lg-2 col-md-4 d-flex justify-content-lg-start justify-content-center">
                                        <div style="height: 15rem; width:15rem;" class="overflow-hidden border border-1 rounded-2">
                                            <img src = "{{ asset('storage/foods/'.$plan->mealPlan->meal_image_path) }}" class="w-100 h-100"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-10 col-12 col-md-8 row gy-0">
                                        <div class ="col-12">
                                            <h1>{{ $plan->mealPlan->meal_name }}</h1>
                                        </div>
                                        <div class ="col-12 d-flex">
                                            <strong>Prepared By: </strong>
                                            <span class="ms-2">{{ $plan->prepared_by }}</span>
                                        </div>
                                        <div class ="col-12 d-flex">
                                            <strong>Delivered By: </strong>
                                            <span class="ms-2">{{ $plan->delivered_by }}</span>
                                        </div>
                                        <div class ="col-12 d-flex">
                                            <strong>Status: </strong>
                                            <span class="ms-2">{{ $plan->meal_order_status }}</span>
                                        </div>
                                        <div class ="col-12 d-flex">
                                            <strong>Meal Type: </strong>
                                            <span class="ms-2">{{ $plan->meal_order_type }}</span>
                                        </div>

                                        @role('ROLE_VOLUNTEER_RIDER')
                                            <div class ="col-12 d-flex">
                                                <strong>Meal Address: </strong>
                                                <span class="ms-2">{{ $plan->prepared_by_address }}</span>
                                            </div>
                                        @endrole

                                        <div class ="col-12 d-flex">
                                            <strong>Address To Deliver: </strong>
                                            <span class="ms-2">
                                                {{ $plan->ordered_by_address }}
                                            </span>
                                        </div>


                                    </div>

                                </div>
                                <div class = "card-footer bg-transparent border-0 d-flex justify-content-end">
                                    <form method="POST" action="{{ route('delivered', $plan) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button class ="btn btn-outline-primary px-5 py-2">
                                            Delivered
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                @endif
            @endforeach
          </div>
    </div>
</div>

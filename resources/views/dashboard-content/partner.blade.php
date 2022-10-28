<div class = "border border-1 px-3 py-3" style="min-height: 10rem;">
    <h3>Welcome to Meals on Wheels, {{Auth::user()->partner_details->partner_name}}!</h3>

    <p>Thank you {{Auth::user()->partner_details->partner_name}} for your support to MerryMeals by helping us with our service.</p>
</div>
<div class = "border border-1 px-5 py-3" style="min-height: 30rem;">
    <span class="fw-bold">Orders to be prepared <a href = "{{route('a-prep-orders')}}" class = "ms-3 text-info fw-normal">View all orders</a></span>
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
                        <div class = "card col-12">
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
                                        <img src = "{{ asset('storage/foods/'.$plan->mealPlan->meal_image_path) }}" class="w-100 h-100" loading="lazy"/>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-12 col-md-8 row gy-0">
                                    <div class ="col-12">
                                        <h1>{{ $plan->mealPlan->meal_name }}</h1>
                                    </div>
                                    <div class ="col-12 d-flex">
                                        <strong>Ordered By: </strong>
                                        <span class="ms-2">{{ $plan->ordered_by }}</span>
                                    </div>
                                    <div class ="col-12 d-flex">
                                        <strong>Distance: </strong>
                                        <span class="ms-2">{{ $plan->prepared_by != null ? calculateDistance($plan->ordered_by_id, $plan->prepared_by_id).' km' : 'pending' }}</span>
                                    </div>
                                    <div class ="col-12 d-flex">
                                        <strong>Status: </strong>
                                        <span class="ms-2">{{ $plan->meal_order_status }}</span>
                                    </div>
                                </div>

                            </div>
                            <div class = "card-footer bg-transparent border-0 d-flex justify-content-end">
                                <form action="{{route('prepared', $plan)}}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class ="btn btn-outline-primary px-5 py-2">
                                        Ready for Packaging
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
                            <div class = "card col-12">
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
                                            <img src = "{{ asset('storage/foods/'.$plan->mealPlan->meal_image_path) }}" class="w-100 h-100" loading="lazy"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-10 col-12 col-md-8 row gy-0">
                                        <div class ="col-12">
                                            <h1>{{ $plan->mealPlan->meal_name }}</h1>
                                        </div>
                                        <div class ="col-12 d-flex">
                                            <strong>Ordered By: </strong>
                                            <span class="ms-2">{{ $plan->ordered_by }}</span>
                                        </div>
                                        <div class ="col-12 d-flex">
                                            <strong>Distance: </strong>
                                            <span class="ms-2">{{ $plan->prepared_by != null ? calculateDistance($plan->ordered_by_id, $plan->prepared_by_id).' km' : 'pending' }}</span>
                                        </div>
                                        <div class ="col-12 d-flex">
                                            <strong>Status: </strong>
                                            <span class="ms-2">{{ $plan->meal_order_status }}</span>
                                        </div>
                                    </div>

                                </div>
                                <div class = "card-footer bg-transparent border-0 d-flex justify-content-end">
                                    <form action="{{route('prepared', $plan)}}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button class ="btn btn-outline-primary px-5 py-2">
                                            Ready for Packaging
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
<div class = "border border-1 px-5 py-3" style="min-height: 30rem;">
    <span class="fw-bold">Your Meal Proposal <a href = "{{route('my-proposal-list')}}" class = "ms-3 text-info fw-normal">View all proposals</a></span>
    <div class = "my-4">
        <div class="accordion" id="proposals">
            @foreach ($proposals as $key => $plan)
            @if ($key == 0)
            <div class="accordion-item">
                <h2 class="accordion-header" id="{{ $plan->meal_name.$key }}">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{ str_replace(' ', '_', $plan->meal_name) }}">
                        Proposal Details
                  </button>
                </h2>
                <div id="{{ str_replace(' ', '_', $plan->meal_name) }}" class="accordion-collapse collapse show" data-bs-parent="#orders">
                  <div class="accordion-body">
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
                  </div>
                </div>
              </div>
            @endif
            @if ($key > 0)
                <div class="accordion-item">
                <h2 class="accordion-header" id="{{ $plan->meal_name.$key }}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"  data-bs-target="#{{ str_replace(' ', '_', $plan->meal_name) }}">
                        Proposal Details
                    </button>
                </h2>
                <div id="{{ str_replace(' ', '_', $plan->meal_name) }}"  class="accordion-collapse collapse show" data-bs-parent="#orders">
                    <div class="accordion-body">
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
                    </div>
                </div>
                </div>
            @endif
        @endforeach
        </div>
    </div>
</div>


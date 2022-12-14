@extends('MealManagement.DeliveryManagement.delivery-management-template')
@section('main')

    <div class = "row gy-2">
        {{-- For each this column --}}
        @forelse ($orders as $order)
            <div class = "card col-12 px-2 pb-3">
                <div class = "card-header border-0 bg-transparent">
                    <div class ="d-flex flex-fill justify-content-lg-end justify-content-center">
                        <div class = "d-flex">
                            <span class="mx-2">
                                <strong>Ordered at:</strong>
                                <span class = "ms-2">{{ date_format(date_create($order->meal_order_ordered_at), 'Y/m/d') }}</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class ="card-body row">
                    <div class = "col-12 col-lg-2 col-md-4 d-flex justify-content-lg-start justify-content-center">
                        <div style="height: 15rem; width:15rem;" class="overflow-hidden border border-1 rounded-2">
                            <img src = "{{ asset('storage/foods/'.$order->mealPlan->meal_image_path) }}" class="w-100 h-100" loading="lazy"/>
                        </div>
                    </div>
                    <div class="col-lg-10 col-12 col-md-8 row gy-0">
                        <div class ="col-12">
                            <h1>{{ $order->mealPlan->meal_name }}</h1>
                        </div>
                        <div class ="col-12 d-flex">
                            <strong>Prepared By: </strong>
                            <span class="ms-2">{{ $order->prepared_by }}</span>
                        </div>
                        <div class ="col-12 d-flex">
                            <strong>Delivered By: </strong>
                            <span class="ms-2">{{ $order->delivered_by }}</span>
                        </div>
                        <div class ="col-12 d-flex">
                            <strong>Status: </strong>
                            <span class="ms-2">{{ $order->meal_order_status }}</span>
                        </div>
                        <div class ="col-12 d-flex">
                            <strong>Meal Type: </strong>
                            <span class="ms-2">{{ $order->meal_order_type }}</span>
                        </div>

                        @role('ROLE_VOLUNTEER_RIDER')
                            <div class ="col-12 d-flex">
                                <strong>Meal Address: </strong>
                                <span class="ms-2">{{ $order->prepared_by_address }}</span>
                            </div>
                        @endrole

                        <div class ="col-12 d-flex">
                            <strong>Address To Deliver: </strong>
                            <span class="ms-2">
                                {{ $order->ordered_by_address }}
                            </span>
                        </div>


                    </div>

                </div>
                <div class = "card-footer bg-transparent border-0 d-flex justify-content-end">
                    <form method="POST" action="{{ route('delivered', $order) }}">
                        @csrf
                        @method('PATCH')
                        <button class ="btn btn-outline-primary px-5 py-2">
                            Delivered
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class = "position-absolute start-50 top-50 translate-middle">
                <div class = "d-flex align-items-center justify-content-center">
                    <h1 class ="display-1 text-muted">
                        No Pending order
                    </h1>
                </div>
            </div>
        @endforelse

    </div>
@endsection

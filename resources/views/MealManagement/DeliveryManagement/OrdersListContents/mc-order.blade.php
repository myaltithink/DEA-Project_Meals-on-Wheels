@extends('MealManagement.DeliveryManagement.delivery-management-template')
@section('main')
<div class = "row gy-2">
        @forelse ($orders as $order)
            <div class = "card col-12">
                <div class = "card-header border-0 bg-transparent">
                    <div class ="d-flex flex-fill justify-content-lg-end justify-content-center">
                        <div class = "d-flex">
                            <span class="mx-2">
                                <strong>Ordered at: </strong>
                                <span class = "ms-2">{{ date_format(date_create($order->meal_order_ordered_at), 'Y/m/d') }}</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class ="card-body row">
                    <div class = "col-12 col-lg-2 col-md-4 d-flex justify-content-lg-start justify-content-center">
                        <div style="height: 15rem; width:15rem;" class="overflow-hidden border border-1 rounded-2">
                            <img src = "{{ asset('storage/foods/'.$order->mealPlan->meal_image_path) }}" class="w-100 h-100"/>
                        </div>
                    </div>
                    <div class="col-lg-10 col-12 col-md-8 row gy-0">
                        <div class ="col-12">
                            <h1>{{ $order->mealPlan->meal_name }}</h1>
                        </div>
                        <div class ="col-12 d-flex">
                            <strong>Prepared By: </strong>
                            <span class="ms-2">{{ $order->prepared_by == null ? 'pending' : $order->prepared_by;  }}</span>
                        </div>
                        <div class ="col-12 d-flex">
                            <strong>Delivered By: </strong>
                            <span class="ms-2">{{ $order->delivered_by == null ? 'pending' : $order->delivered_by;  }}</span>
                        </div>
                        <div class ="col-12 d-flex">
                            <strong>Distance: </strong>
                            <span class="ms-2">{{ $order->prepared_by != null ? calculateDistance($order->ordered_by_id, $order->prepared_by_id).' km' : 'pending' }}</span>
                        </div>

                        <div class ="col-12 d-flex">
                            <strong>Status: </strong>
                            <span class="ms-2">{{ $order->meal_order_status }}</span>
                        </div>
                        <div class ="col-12 d-flex">
                            <strong>Meal Type: </strong>
                            <span class="ms-2">{{ 'frozen or hot' }}</span>
                        </div>
                        <div class ="col-12 d-flex">
                            <strong>Delivery Date: </strong>
                            <span class="ms-2">
                                {{ $order->meal_order_delivered_at != null ? date_format(date_create($order->meal_order_delivered_at), 'Y/m/d').' at '.date_format(date_create($order->meal_order_delivered_at), 'H:i:s') : 'pending'; }}
                            </span>
                        </div>

                    </div>

                </div>

            </div>

        @empty
            <div class = "position-absolute start-50 top-50 translate-middle">
                <div class = "d-flex align-items-center justify-content-center">
                    <h1 class ="display-1 text-muted">
                        No Orders Yet
                    </h1>
                </div>
            </div>
        @endforelse
    </div>
@endsection

@extends('MealManagement.DeliveryManagement.delivery-management-template')
@section('main')
    <div class = "row gy-2">
        {{-- For each this column --}}
        @forelse ($pendingOrders as $order)
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
                            <img src = "{{ asset('storage/foods/'.$order->mealPlan->meal_image_path) }}" class="w-100 h-100"/>
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
                            <strong>Ordered By: </strong>
                            <span class="ms-2">{{ $order->ordered_by }}</span>
                        </div>

                        <div class ="col-12 d-flex">
                            <strong>Status: </strong>
                            <span class="ms-2">{{ $order->meal_order_status }}</span>
                        </div>
                    </div>

                </div>
                <div class = "card-footer bg-transparent border-0 d-flex justify-content-end">
                    <button class ="btn btn-outline-primary px-5 py-2" data-bs-toggle ="modal" data-bs-target = "#select-to-deliver" data-select-meal-delivery='{{ $order->meal_order_id }}'>
                        Assign To
                    </button>
                </div>
            </div>
        @empty
            <div class = "position-absolute start-50 top-50 translate-middle">
                <div class = "d-flex align-items-center justify-content-center">
                    <h1 class ="display-1 text-muted">
                        No Orders to Deliver
                    </h1>
                </div>
            </div>
        @endforelse

    </div>
@endsection
@section('modals')
    <div class="modal fade" data-bs-backdrop="static" id = "select-to-deliver">
        <div class="modal-dialog modal-fullscreen-md-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select Personnel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-select-remove = "#select-to-deliver"></button>
                </div>
                <div class="modal-body modal-dialog-scrollable row gy-2">
                    @foreach ($personels as $personel)
                        <div class ="card">
                            <div class="card-body">
                                <h1 class = "fw-bold">
                                    {{ $personel->volunteer_details->volunteer_name }}
                                </h1>
                                <div class="d-flex">
                                    <strong>Volunteer Organization:</strong>
                                    <span class = "ms-2"> {{ $personel->volunteer_details->organization_name }}</span>
                                </div>
                            </div>
                            <div class ="card-footer bg-transparent border-0">
                                <button class = "categ-link border border-0 bg-transparent"
                                    style = "width:0; height:0%;"
                                    data-select-rider = "{{ $personel->user_id }}"
                                ></button>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class= "modal-footer">
                    <form method="POST" action="{{ route('assign-meal-delivery') }}" id = "assign-order-deliver">
                        @csrf
                        @method('PUT')
                        <input type = "hidden" id = "selected-order" name = "selected-order">
                        <input type = "hidden" id = "selected-person" name = "selected-person">
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        @vite(['resources/js/delivery-management-prompt.js'])
    @endpush
@endsection

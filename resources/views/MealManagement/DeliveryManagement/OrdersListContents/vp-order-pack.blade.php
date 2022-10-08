@extends('MealManagement.DeliveryManagement.delivery-management-template')
@section('main')
    <div class = "row gy-2">
        {{-- For each this column --}}
        <div class = "card col-12 px-2 pb-3">
            <div class = "card-header border-0 bg-transparent">
                <div class ="d-flex flex-fill justify-content-lg-end justify-content-center">
                    <div class = "d-flex">
                        <span class="mx-2">
                            <strong>Ordered at:</strong>
                            <span class = "ms-2"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class ="card-body row">
                <div class = "col-12 col-lg-2 col-md-4 d-flex justify-content-lg-start justify-content-center">
                    <div style="height: 15rem; width:15rem;" class="overflow-hidden border border-1 rounded-2">
                        <img src = "{{ asset('storage/foods/ayanokojik.jpg') }}" class="w-100 h-100"/>
                    </div>
                </div>
                <div class="col-lg-10 col-12 col-md-8 row gy-0">
                    <div class ="col-12">
                        <h1>Food Name</h1>
                    </div>
                    <div class ="col-12 d-flex">
                        <strong>Ordered By: </strong>
                        <span class="ms-2"></span>
                    </div>

                    <div class ="col-12 d-flex">
                        <strong>Distance: </strong>
                        <span class="ms-2"></span>
                    </div>

                    <div class ="col-12 d-flex">
                        <strong>Status: </strong>
                        <span class="ms-2"></span>
                    </div>

                    <div class ="col-12 d-flex">
                        <strong>Meal Type: </strong>
                        <span class="ms-2"></span>
                    </div>

                </div>

            </div>
            <div class = "card-footer bg-transparent border-0 d-flex justify-content-end">
                <button class ="btn btn-outline-primary">
                    Ready for Packaging
                </button>
            </div>
        </div>
    </div>
@endsection

@extends('MealManagement.DeliveryManagement.delivery-management-template')
@section('main')
    <div class = "row g-4">
        {{--do a for loop here later--}}
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="card" style="height:20rem;">
                <div class = "card-header overflow-hidden p-0 bg-transparent" style="height: 10rem;">
                    <img src = "{{ asset('storage/foods/ayanokojik.jpg') }}" class="card-img-top"/>
                </div>
                <div class="card-body">
                    <span class="text-center text-uppercase h3 d-block">WASDWASDWASDWAD</span>
                </div>
                <div class= "card-footer bg-transparent border border-0 p-2">
                    @HasAnyRole(['ROLE_MEMBER', 'ROLE_CARETAKER'])
                        <a href = "" class="btn btn-primary w-100">
                            Order
                        </a>
                    @EndHasAnyRoles
                    @ExcludeRole(['ROLE_MEMBER', 'ROLE_CARETAKER'])
                        <button class="btn btn-outline-success w-100" @disabled(true)>
                            Approved Meal Plan
                        </button>
                    @EndExcludeRole
                </div>
            </div>
        </div>
    </div>
@endsection

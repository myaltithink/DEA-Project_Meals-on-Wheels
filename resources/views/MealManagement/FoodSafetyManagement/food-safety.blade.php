@extends('layouts.foodsafety')

@section('subcontent')
<div class="bg-light">
    <div class="container py-5">
        
        <div class="row mb-4 text-center">
            <div class="col-lg-12">
            <h2 class="display-12 fw-bold">Pending Meal Proposals</h2>
            </div>
        </div>
  
        <div class="row text-center">
            @forelse ($proposals as $proposal)
                <!-- Team item-->
                <div class="col-xl-3 col-sm-6 mb-5">
                <div class="bg-white rounded shadow-sm pt-5 px-4 border border-dark">
                    <img src="{{ asset('storage/foods/'.$proposal->meal_image_path) }}" alt="Meal" width="100" class="img-fluid mb-3 img-thumbnail shadow-sm">
                    <h5 class="mb-0">{{ ucwords($proposal->meal_name) }}</h5><br>
                    <a href="{{ route('meal-proposal-approval', $proposal) }}"><button class="btn btn-primary my-4" id="button">VIEW</button></a>
                </div>
                </div>
                <!-- End-->

                @empty
                {{-- <div class = "position-absolute start-50 top-50 translate-middle">
                    <div class = "d-flex align-items-center justify-content-center"> --}}
                    <div class="my-5">
                        <h1 class ="display-1 text-muted my-4">
                            No Pending Meal Proposals Yet
                        </h1>
                    </div>
                    {{-- </div>
                </div> --}}

            @endforelse

      </div>
    </div>
</div>
@endsection
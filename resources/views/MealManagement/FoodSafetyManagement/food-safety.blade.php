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
                    <img src="{{ asset('storage/foods/'.$proposal->meal_image_path) }}" alt="Meal Image" width="100" class="img-fluid mb-3 img-thumbnail shadow-sm" loading="lazy">
                    <h5 class="">{{ ucwords($proposal->meal_name) }}</h5>

                    @if ( $proposal->organization != null)
                        <span>{{ ucwords($proposal->organization) }}</span><br/>
                    @else
                        <span>{{ ucwords($proposal->proposed_by) }}</span><br/>
                    @endif

                    <a href="{{ route('meal-proposal-approval', $proposal) }}"><button class="btn btn-primary my-4" id="button">VIEW</button></a>
                </div>
                </div>
                <!-- End-->

                @empty
                    <div class="my-5">
                        <h1 class ="display-1 text-muted my-4">
                            No Pending Meal Proposals Yet
                        </h1>
                    </div>
            @endforelse
      </div>
    </div>
</div>
@endsection

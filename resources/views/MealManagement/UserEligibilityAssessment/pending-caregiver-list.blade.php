@extends('MealManagement.UserEligibilityAssessment.user-assessment-template')
@section('main')
<div class="">
    <div class="container py-5">
        <div class="row text-center">
            @forelse ($users as $user)
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="bg-white rounded shadow-sm pt-4 px-2 border border-dark">
                        <h3 class=""> {{ ucwords($user->caregiver_details->profile->first_name) }} {{ ucwords($user->caregiver_details->profile->last_name) }} </h3>
                        <span> {{ $user->email }} </span><br>
                        <a href="{{ route('view-caregiver', $user->email) }}"><button class="btn btn-primary w-100 mb-2 mt-3" id="button">VIEW</button></a><br>
                    </div>
                </div>

                @empty
                <div class="my-5">
                    <h1 class ="display-1 text-muted my-4">
                        No Pending Caregivers Yet
                    </h1>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

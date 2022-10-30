@extends('layouts.foodsafety')

@section('subcontent')
    <div class="container my-5">
        <h1 class="text-center fw-bold">Meal Approval</h1>
        <div class="row my-3 justify-content-center">
          <div class="col-md-6 bg-white shadow rounded mx-2 my-2 border border-dark">
            <div class="thumbnail mt-2">
                <div class="text-center mt-5">
                    <img src="{{ asset('storage/foods/'.$proposal->meal_image_path) }}" alt="Meal Proposal" class="w-50 h-50" loading="lazy">
                </div>

                <h2 class = "tetxt-center fw-bold text-center mt-2"> {{ ucwords($proposal->meal_name )}} </h2>

                <div class="mt-3 mx-5" style="font-size: 18px">
                    <p class="mb-0 mt-2"><strong>Proposed By:</strong> {{ ucwords($proposal->proposed_by )}} </p>
                    <p class="mb-0 mt-2"><strong>Organization:</strong> {{ ucwords($proposal->organization )}} </p>
                    <p class="mb-0 mt-2"><strong>Ingredients:</strong>
                        <ul>
                            @foreach (explode(',', $proposal->meal_ingredients) as $ingredient)
                                <li>{{ ucwords($ingredient) }}</li>
                            @endforeach
                        </ul>  </p>
                </div>
                <div style="float: right;" class="mb-4 mx-3">
                    <button class = "btn btn-outline-danger mx-1" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                        <strong>REJECT</strong>
                    </button>
                    <button class = "btn btn-primary mx-1" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        APPROVE
                    </button>

               </div>

            </div>
          </div>

        </div>
      </div>

  <!-- Approve Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body text-center">
          <i class="fa fa-check-circle mt-2" aria-hidden="true" style="color: green; font-size: 50px"></i>
          <h3 class="mt-3"><strong> Approve this meal proposal? </strong></h3>
        </div>
        <div class="d-flex justify-content-center mb-4">
          <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">CLOSE</button>
          <form method="POST" action ="{{ route('approve-meal-proposal') }}">
            @csrf
              <input type="hidden" name="meal-id" value="{{ $meal_id }}"/>
              <button type="submit" class="btn btn-primary mx-2">YES</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Reject Modal -->
  <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body text-center">
          <i class="fa fa-exclamation-circle" aria-hidden="true" style="color: red; font-size: 50px"></i>
          <h3 class="mt-3"><strong> Reject this meal proposal? </strong></h3>
        </div>
        <form method="POST" action ="{{ route('reject-meal-proposal') }}">
          @csrf

          <div class="mb-3 mx-auto col col-lg-10" >
            <label><strong> Reason of rejection:</strong></label><br/>
            <textarea name="reason" class="form-control" placeholder="Please enter the reason of rejection." required></textarea>
          </div>

          <div class="d-flex justify-content-center mb-4">
            <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">CLOSE</button>
            <input type="hidden" name="meal-id" value="{{ $meal_id }}"/>
            <button type="submit" class="btn btn-primary mx-2">YES</button>
          </div>

        </form>
      </div>
    </div>
  </div>

@endsection

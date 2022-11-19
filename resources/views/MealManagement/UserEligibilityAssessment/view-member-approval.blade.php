@extends('layouts.foodsafety')

@section('subcontent')
    <div class="container my-5">
        <h1 class="text-center fw-bold">Member Approval</h1>
        <div class="row my-3 justify-content-center">
          <div class="col-md-6 bg-white shadow rounded mx-2 my-2 border border-dark">
            <div class="mx-3 my-4">
                {{-- member's profile information --}}
                <div class="">
                    <h4><strong>Profile</strong></h4>
                    <div class="mx-2">
                        <div class="row" style="font-size: 18px">
                            <div class="col-md-6">
                                <p><strong>Name:</strong> {{ ucwords($profile->first_name) }} {{ ucwords($profile->last_name) }} </p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Gender:</strong> {{ ucwords($profile->gender) }} </p>
                            </div>
                            <div class="col-md-2">
                                <p><strong>Age:</strong> {{ $profile->age }} </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Address:</strong> {{ ucwords($profile->address) }} </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Birthday:</strong> {{ $profile->birthday }} </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Contact Number:</strong> {{ $profile->contact_number }} </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Email:</strong> {{ $member->email }} </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- member's needs and allergies information --}}
                <div>
                    <div class="">
                        <div class="row" style="font-size: 18px">
                            <div class="col-md-6">
                                <h4><strong>Needs:</strong></h4>
                                <div class="mx-2">
                                    <p> {{ ucfirst($details->needs) }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4><strong>Allergies:</strong></h4>
                                <div class="mx-2">
                                    <p> {{ ucfirst($details->allergies) }} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- member's proof of identity --}}
                <div>
                    <h4><strong>Identity</strong></h4>
                    <div class="mx-2">
                        <div class="row" style="font-size: 18px">
                            <div class="col-md-6">
                                <p><strong>Valid ID:</strong></p>
                            </div>
                        </div>
                        <img src="{{ Vite::asset($profile->valid_id) }}" alt="Valid ID" class="w-100 h-100 mb-3">
                    </div>

                    <div class="mx-2">
                        <div class="row" style="font-size: 18px">
                            <div class="col-md-6">
                                <p><strong>Proof of Eligibility:</strong></p>
                            </div>
                        </div>
                        <img src="{{ Vite::asset($details->proof_of_eligebility) }}" alt="Proof of Eligibility" class="w-100 h-100 mb-3">
                    </div>
                </div>

                <div style="float: right;" class="mb-4 mx-3">
                    <button class = "btn btn-outline-danger mx-1 " type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
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
          <h3 class="mt-3"><strong> Approve this member? </strong></h3>
        </div>
        <div class="d-flex justify-content-center mb-4">
          <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">CLOSE</button>
          <form method="POST" action ="{{ route('approve-member') }}">
            @csrf
              <input type="hidden" name="user-id" value="{{ $user_id }}"/>
              <button type="submit" class="btn btn-primary mx-2 w-100">YES</button>
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
          <h3 class="mt-3"><strong> Reject this member? </strong></h3>
        </div>
        <form method="POST" action ="{{ route('reject-member') }}">
          @csrf

          <div class="mb-3 mx-auto col col-lg-10" >
            <label><strong> Reason of rejection:</strong></label><br/>
            <textarea name="reason" class="form-control" placeholder="Please enter the reason of rejection." required></textarea>
          </div>

          <div class="d-flex justify-content-center mb-4">
            <button type="button" class="btn btn-secondary mx-2 w-25" data-bs-dismiss="modal">CLOSE</button>
            <input type="hidden" name="user-id" value="{{ $user_id }}"/>
            <button type="submit" class="btn btn-primary mx-2 w-25">YES</button>
          </div>

        </form>
      </div>
    </div>
  </div>

@endsection

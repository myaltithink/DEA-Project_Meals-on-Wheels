@extends('register')
@section('registration-form')
    <div class="form-control border-0 left-padding">
        <h4>Profile</h4>

        <div>
            <label for="company-name">Company / Organization Name <i class="required"><small>(required)</small></i></label>
            <input type="text" name="company-name" id="company-name" class="form-control mb-0">
            <small class="error-message"></small>
        </div>

        <div>
            <label for="registered-by">Registered By <i class="required"><small>(required)</small></i></label>
            <input type="email" name="registered-by" id="registered-by" class="form-control mb-0 mb-0">
            <small class="error-message"></small>
            <p style="font-size: 14px">Email address of the person from the company or organization who is registering this
                account</p>
        </div>

        <div>
            <label for="partner-address">Address <i class="required"><small>(required)</small></i></label>
            <input type="text" name="partner-address" id="partner-address" class="form-control mb-0">
            <small class="error-message"></small>
        </div>
    </div>
    <hr>
    @include('registration.components.identity')
    <hr>
    @include('registration.components.account')
@endsection

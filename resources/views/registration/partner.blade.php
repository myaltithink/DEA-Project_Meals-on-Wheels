@extends('register')
@section('registration-form')
    <div class="form-control border-0 left-padding">
        <h4>Profile</h4>

        <div>
            <label for="company-name">Company / Organization Name</label>
            <input type="text" name="company-name" class="form-control">
        </div>

        <div>
            <label for="registered-by">Registered By</label>
            <input type="text" name="registered-by" class="form-control mb-0">
            <p style="font-size: 14px">Email address of the person from the company or organization who is registering this
                account</p>
        </div>

        <div>
            <label for="partner-address">Address</label>
            <input type="text" name="partner-address" class="form-control">
        </div>
    </div>
    <hr>
    @include('registration.components.identity')
    <hr>
    @include('registration.components.account')
@endsection

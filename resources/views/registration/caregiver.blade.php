@extends('register')
@section('registration-form')
    @include('registration.components.user-profile')
    <hr>
    @include('registration.components.identity')
    <hr>

    <div class="form-control border-0 left-padding">
        <h4 class="mb-0">Member Details</h4>
        <p>If the member you will be taking care of is not
            registered yet, Please Register them as a Member
            first.
            <br><br>
            If you are not taking care of any member, leave this
            section blank
        </p>

        <div>
            <label for="member-name">Member Name</label>
            <input type="text" name="member-name" class="form-control">
        </div>
        <div>
            <label for="member-email">Member Email</label>
            <input type="text" name="member-email" class="form-control">
        </div>
    </div>

    <hr>
    @include('registration.components.account')
@endsection

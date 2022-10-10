@extends('register')
@section('registration-form')
    @include('registration.components.user-profile')
    <hr>
    <div id="member-needs" class="form-control left-padding border-0">
        <h4 class="m-0">Needs</h4>

        <label for="needs">What do you need? and Why</label>
        <textarea name="needs" id="needs" class="form-control rounded-0" cols="30" rows="5"></textarea>

        <label for="allergies">Food Allergies <i>if any otherwise leave blank</i></label>
        <textarea name="allergies" id="allergies" class="form-control rounded-0" cols="30" rows="5"></textarea>
    </div>

    <hr>
    @include('registration.components.identity')
    <hr>
    @include('registration.components.account')
@endsection

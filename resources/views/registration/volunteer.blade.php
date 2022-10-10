@extends('register')
@section('registration-form')
    @include('registration.components.user-profile')
    <hr>

    <div class="form-control border-0 left-padding">
        <h4>Role</h4>

        <input type="checkbox" name="volunteer-kitchen" id="volunteer-kitchen" value="Outsource Kitchen">
        <label for="volunteer-kitchen">Outsource Kitchen</label><br>
        <input type="checkbox" name="volunteer-rider" id="volunteer-rider" value="Rider">
        <label for="volunteer-rider">Rider</label><br>

        <p style="font-size: 14px">

            <b>Oursource Kitche </b> - people who are willing to take the same responsibility of a
            Partner Kitchen and cook the meals that the members or caregiver ordered
            <br><br>
            <b>Rider </b> - people who are willing to drive and pick up the meal from the kitchen it was cooked at and
            deliver them to the member or caregiver who ordered it
            <br><br>
            <i>If you wish to volunteer as a caregiver, consider registering as a Caregiver and leave the Member Detals
                section blank</i>
        </p>

    </div>

    <hr>
    @include('registration.components.identity')
    <hr>
    @include('registration.components.account')
@endsection

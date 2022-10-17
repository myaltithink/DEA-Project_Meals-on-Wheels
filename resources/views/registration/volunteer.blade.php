@extends('register')
@section('registration-form')
    @include('registration.components.user-profile')
    <hr>

    <div class="form-control border-0 left-padding">
        <h4>Role <i class="required"><small>(required)</small></i></h4>

        <input type="checkbox" name="volunteer-kitchen" id="volunteer-kitchen" value="Outsource Kitchen"
            {{ old('volunteer-kitchen') == 'Outsource Kitchen' ? 'checked' : '' }}>
        <label for="volunteer-kitchen">Outsource Kitchen</label><br>
        <input type="checkbox" name="volunteer-rider" id="volunteer-rider" value="Rider"
            {{ old('volunteer-rider') == 'Rider' ? 'checked' : '' }}>
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
    <div class="form-control border-0 left-padding">
        <h4 class="mb-0">Organization</h4>
        <p>
            You may leave this section blank if you do not belong to any organization
        </p>

        <div>
            <label for="organization-name">Organization Name</label>
            <input type="text" name="organization-name" id="organization-name" class="form-control nullable"
                value="{{ old('organization-name', '') }}">
        </div>
        <div>
            <label for="organization-address">Organization Address</label>
            <input type="text" name="organization-address" id="organization-address" class="form-control nullable"
                value="{{ old('organization-address', '') }}">
        </div>
    </div>
    <hr>
    @include('registration.components.account')
@endsection

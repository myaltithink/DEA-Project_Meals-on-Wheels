@extends('layouts.base')

@section('content')
    @role('ROLE_ADMIN')
        <h3>admin dashboard</h3>
    @endrole

    @role('ROLE_MEMBER')
        <h3>member dashboard</h3>
    @endrole

    @role('ROLE_CAREGIVER')
        <h3>caregiver dashboard</h3>
    @endrole

    @role('ROLE_PARTNER')
        <h3>partner dashboard</h3>
    @endrole

<<<<<<< Updated upstream
    @role('ROLE_VOLUNTEER')
        <h3>volunteer dashboard</h3>
=======
    @role('ROLE_VOLUNTEER_COOK')
        @include('dashboard-content.volunteer-cook')
    @endrole

    @role('ROLE_VOLUNTEER_RIDER')
        @include('dashboard-content.volunteer-rider')
>>>>>>> Stashed changes
    @endrole
@endsection

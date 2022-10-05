@extends('layouts.base')

@section('content')
    @role('ROLE_ADMIN')
        @include('dashboard-content.admin')
    @endrole

    @role('ROLE_MEMBER')
        @include('dashboard-content.member')
    @endrole

    @role('ROLE_CAREGIVER')
        @include('dashboard-content.caregiver')
    @endrole

    @role('ROLE_PARTNER')
        @include('dashboard-content.partner')
    @endrole

    @role('ROLE_VOLUNTEER_COOK')
        @include('dashboard-content.volunter-cook')
    @endrole

    @role('ROLE_VOLUNTEER_RIDER')
        @include('dashboard-content.volunteer-rider')
    @endrole
@endsection

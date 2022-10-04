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

    @role('ROLE_VOLUNTEER')
        <h3>volunteer dashboard</h3>
    @endrole
@endsection

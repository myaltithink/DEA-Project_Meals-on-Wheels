<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="{{ URL::asset('favicon.ico') }}">
    @vite(['resources/css/app.css', 'node_modules/bootstrap/dist/css/bootstrap.min.css', 'node_modules/@fortawesome/fontawesome-free/css/all.min.css'])
</head>

<body>
    @include('components.header')

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

</body>


</html>

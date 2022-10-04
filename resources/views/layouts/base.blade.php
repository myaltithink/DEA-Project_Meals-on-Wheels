<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'laravel') }}</title>
    <link rel="icon" href="{{ URL::asset('favicon.ico') }}">
    <style>
        #registration-type {
            width: fit-content;
            display: flex;
            margin-left: 10px
        }

        #registration-type button {
            margin: 0;
            border-radius: 0;
            border: gray solid 1px;
            border-right: none
        }
    </style>
    @vite(['resources/css/app.css', 'node_modules/bootstrap/dist/css/bootstrap.min.css', 'node_modules/@fortawesome/fontawesome-free/css/all.min.css'])
</head>

<body>
    @include('components.header')
    @yield('content')
</body>


</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="DEA MerryMeal Meals On Wheels">
    <title>{{ config('app.name', 'laravel') }}</title>
    <link rel="icon" href="{{ URL::asset('favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/css/app-mobile.css', 'resources/js/app.js',
        'node_modules/bootstrap/dist/css/bootstrap.min.css', 'node_modules/@fortawesome/fontawesome-free/css/all.min.css',
        'node_modules/bootstrap/dist/js/bootstrap.js'])

    @stack('styles')
    @stack('scripts')

</head>

<body>
    @include('components.header')
    @yield('content')
    @include('components.footer')
</body>


</html>

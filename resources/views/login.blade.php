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

    <form action="{{ route('login.user') }}" method="POST" class="form-control w-75 border-dark m-5">

        <div class="form-control border-0">
            <label for="email">Email</label>
            <input type="text" name='email' class="form-control">
        </div>
        <div class="form-control border-0">
            <label for="password">Password</label>
            <input type="password" name='password' class="form-control">
        </div>

        <div class="form-control border-0">
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </div>

        @csrf

    </form>

</body>


</html>

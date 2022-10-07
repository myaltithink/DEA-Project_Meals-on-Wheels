@extends('layouts.base')
@section('content')
    <div id="hero-banner"></div>

    <div id="main-content">
        <div>
            <div id="welcome-block" class="main-child d-md-flex">
                <div class="img-container col-12 col-md-6 col-lg-7 col-xl-5"
                    style="background-image: url('{{ Vite::asset('resources/images/welcome-block-img.jpg') }}')">
                </div>

                <div class="block-content">
                    <p>sjfdnsojdfn</p>
                </div>
            </div>
            <div id="registration-block" class="main-child d-md-flex">
                <div class="block-content">
                    <p>dofjvdjvn</p>
                </div>
                <div class="img-container col-12 col-md-6 col-lg-7 col-xl-5"
                    style="background-image: url('{{ Vite::asset('resources/images/registration-block-img.jpg') }}')">
                </div>
            </div>
        </div>

    </div>
@endsection

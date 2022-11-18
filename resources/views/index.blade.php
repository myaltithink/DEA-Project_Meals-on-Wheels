@extends('layouts.base')
@section('content')
    <div id="hero-banner"></div>

    <h1 class="text-center mt-5">Welcome to Meals on Wheels</h1>

    <div id="main-content">
        <div>
            <div id="welcome-block" class="main-child d-md-flex">
                <div class="img-container img-background col-12 col-md-6 col-lg-7 col-xl-5"
                    style="background-image: url('{{ Vite::asset('resources/images/welcome-block-img.jpg') }}')">
                </div>

                <div class="block-content mt-4 mt-md-0 ms-md-5">
                    <div>
                        <h3>What is Meals on Wheels?</h3>
                        <p>Meals on Wheels is a service application that is owned and used by MerryMeals to provide
                            struggling
                            adults who are unable to cook for themself due to unavoidable cause like being sick or disabled
                            to
                            have a hot and nutritional Meal</p>
                        <p>Merry Meals is a charitable organization so a support would be much appreciated</p>
                        <p>You may send us a message at our <a href="#">Contact Us</a> Page or send us a donation
                            through
                            our <a href="{{ url('/donation') }}">Donation Page</a></p>
                    </div>
                </div>
            </div>
            <hr>
            <div id="registration-block" class="main-child d-md-flex">
                <div class="block-content ms-0 me-5">
                    <div>
                        <h3>Do you want to also help people in need?</h3>
                        <p>As a charitable organization, we are also open to partners or volunteers who are able to cook to
                            provide a wider range of service for those who are in need that are outside of our reach</p>
                        <p>You may register at our <a href="/register-partner">Partner</a> / <a
                                href="/register-volunteer">Volunteer</a>
                            Registration
                            Page</p>
                    </div>
                </div>
                <div class="img-container img-background col-12 col-md-6 col-lg-7 col-xl-5"
                    style="background-image: url('{{ Vite::asset('resources/images/registration-block-img.jpg') }}')">
                </div>
            </div>
        </div>

    </div>
@endsection

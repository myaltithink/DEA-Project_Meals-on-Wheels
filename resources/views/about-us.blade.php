@extends('layouts.base')
@section('content')
<div id = "about-us" class ="bg-light" style="min-height:35rem;">
    <div class = "container py-5">
        <nav class = "nav-tabs-wrapper">
            <button class = "nav-tab-selector" data-navtabs-selected = "true" data-navtabs-target = "#our-company">About Us</button>
            <button class = "nav-tab-selector" data-navtabs-selected = "false" data-navtabs-target = "#our-mission">Our Mission</button>
            <button class = "nav-tab-selector" data-navtabs-selected = "false" data-navtabs-target = "#our-vision">Our Vision</button>
        </nav>
        <div class = "nav-tab-container" style = "min-height:20rem;">
            <div class = "nav-tab-content tab-animation-fade tab-active p-3" data-navtab-toggled ="true" id = "our-company">
                <h1 class = "fw-bolder text-uppercase">About Merry Meals</h1>
                <div class ="row gy-2">
                    <p class = "col-12 h5 fw-normal">
                        MerryMeal is a charitable organization which prepares and deliver meals to qualified adults living at home,
                        the said qualified adults are those who are unable to cook for themselves or unable to maintain their nutritional status due to age,
                        disease or disability. Additionally, the MerryMeal Delivery Service is only available from <strong>Monday to Friday</strong>,
                        and they have partnered with several food service providers across the nation to enable a larger scope of service
                        for struggling adults. Unfortunately, when a member is outside of the 10-kilometer radius of any outsourced kitchen
                        or they have ordered a food on Saturday or Sunday, they will be receiving Frozen meals instead.
                    </p>
                </div>
            </div>
            <div class = "nav-tab-content tab-animation-fade p-3" data-navtab-toggled ="false" id = "our-mission">
                <h1 class = "fw-bolder text-uppercase">Our purpose</h1>
                <div class = "row">
                    <div class ="col-12">
                        <h5>Driven by the will to serve, we commit ourselves to:</h5>
                    </div>
                    <div class ="col-12">
                        <ul class = "row gy-3 h5 fw-normal">
                            <li class = "col-12">
                                To improve the quality of life of the needy people by providing hot noon meals for those who cannot provide
                                for themselves.
                            </li>
                            <li class = "col-12">
                                Raise awareness of the societal issue within the community and expand the reach of the service.
                            </li>
                            <li class = "col-12">
                                Reduce the gap between private corporations and community by acting as a bridge advocating
                                to address a common issue for the better of the society.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class = "nav-tab-content tab-animation-fade p-3" data-navtab-toggled ="false" id = "our-vision">
               <h1 class = "fw-bolder text-uppercase">Our Vision</h1>
                <div class="h5 fw-normal">
                    We aim to be a leading figure in terms of providing needy people who cannot provide for themselves with
                    a hot noon meal. By leading the campaign, our cause, will motivate the community as well as the business
                    organizations to address the issue and shorten the gap between the community and businesses.
                </div>
            </div>
        </div>
    </div>
</div>
@vite(['resources/css/about-us.css', 'resources/js/about-us.js'])
@endsection

<div id="nav-bg" class="d-none" onclick="handleNavigation('close')"></div>

<header class="d-flex justify-content-between">
    <a href=  "{{route('home')}}" class="logo">
        <img src="{{ Vite::asset('resources/images/logo.png') }}" class="rounded m-2 " alt="logo" height="50"
            width="50">
    </a>

    <i id="open-navigation" class="d-md-none fa fa-bars fa-2x m-3" onclick="handleNavigation('open')"></i>
    <ul id="navigation-links" class="page-load d-md-flex">
        <div id="m-close-nav" class="d-md-none">
            <i id="close-navigation" class="fa fa-close fa-2x" onclick="handleNavigation('close')"></i>
        </div>

        @guest
            {{--terms and conditions, about us pages missing--}}
            <li><a href="" class="d-block nav-item-link">Contact Us</a></li>
            <li><a href="" class="d-block nav-item-link">Donation</a></li>
            <li><a href="/login" class="d-block nav-item-link">Login</a></li>
            <li><a href="/register" class="d-block nav-item-link">Register</a></li>
        @endguest
        @auth
            <li class="d-block">
                <input type = "checkbox" name = "support" id = "support" class = "nav-button-toggle" onchange="togglePopup(this)">
                <label for = "support" class="nav-toggler nav-item-link">
                    Support
                    <div class = "popup pointer">
                        <div class = "card border p-0 m-0 border-0 bg-transparent">
                            <div class ="card-body p-0 m-0">
                                <ul class="list-group m-0 p-0">
                                    <li class="list-group-item list-group-item-action">Contact Us</li>
                                    <li class="list-group-item list-group-item-action">Donation</li>
                                    <li class="list-group-item list-group-item-action">About Us</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </label>
            </li>
            <li class="d-block">
                <input type = "checkbox" name = "management" id = "management" class = "nav-button-toggle" onchange="togglePopup(this)">
                <label for = "management" class="nav-toggler nav-item-link">
                    Management
                    <div class = "popup pointer">
                        <div class = "card border border-0 p-0 m-0 bg-transparent">
                            <div class ="card-body p-0 m-0">
                                <ul class="list-group m-0 p-0">
                                    <li class="list-group-item list-group-item-action">Eligibility Assessment</li>
                                    <li class="list-group-item list-group-item-action">Food Safety</li>
                                    <li class="list-group-item list-group-item-action">General Management</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </label>
            </li>
            <li class="d-block"><a href="/profile" class="nav-item-link">Profile</a></li>
            <li class="d-block">
                <input type = "checkbox" name = "meals" id = "meals" class = "nav-button-toggle" onchange="togglePopup(this)">
                <label for = "meals" class="nav-toggler nav-item-link">
                    Meals
                    <div class = "popup pointer">
                        <div class = "card border border-0 p-0 m-0 bg-transparent">
                            <div class ="card-body p-0 m-0">
                                <ul class="list-group m-0 p-0">
                                    <li class="list-group-item list-group-item-action">Meals</li>
                                    <li class="list-group-item list-group-item-action">Meals Proposal</li>
                                    <li class="list-group-item list-group-item-action">Orders</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </label>
            </li>
            {{--<li><a href="/Management" class="d-block nav-item-link">Management</a></li>--}}
            {{-- <li class="d-block"><a href="/meal" class="nav-item-link">Meal</a></li> --}}
            <li class="d-block"><a href="/logout" class="nav-item-link">Logout</a></li>
        @endauth
    </ul>
</header>

<script>
    window.addEventListener("resize", () => {
        if (window.innerWidth > 767) {
            const navigation = document.getElementById("navigation-links");
            const bg = document.getElementById("nav-bg");

            bg.classList.remove('d-block')
            bg.classList.add('d-none')
            navigation.classList.remove("show-m-nav")
            navigation.classList.remove("close-m-nav")
        }
    })

    function handleNavigation(action) {
        const navigation = document.getElementById("navigation-links");
        const bg = document.getElementById("nav-bg");
        switch (action) {
            case "open":
                console.log("open navigation")
                bg.classList.remove('d-none')
                bg.classList.add('d-block')
                navigation.classList.remove("close-m-nav")
                navigation.classList.add("show-m-nav")
                break;

            case "close":
                console.log("close navigation")
                bg.classList.remove('d-block')
                bg.classList.add('d-none')
                navigation.classList.remove("show-m-nav")
                navigation.classList.add("close-m-nav")
                break;
        }
    }

    //script for toggling popups
    function togglePopup(navbox){
       const navButtons = document.querySelectorAll(".nav-button-toggle");
       navbox.nextElementSibling.firstElementChild.classList.add("fade");
       navButtons.forEach(nav => {
            nav.checked = false;
        });
       setTimeout(() => {
            navbox.checked = true;
            navbox.nextElementSibling.firstElementChild.classList.remove('fade');
       }, 500);

    }
</script>

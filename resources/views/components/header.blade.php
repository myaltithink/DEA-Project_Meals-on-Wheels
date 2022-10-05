<header class="d-flex justify-content-between">
    <a @auth href="{{ route('dashboard') }}" @endauth @guest href="{{ route('home') }}" @endguest class="logo">
        <img src="{{ Vite::asset('resources/images/logo.png') }}" class="rounded m-2 " alt="logo" height="50"
            width="50">
    </a>

    <i id="open-navigation" class="d-md-none fa fa-bars fa-2x m-3" onclick="handleNavigation('open')"></i>
    <ul id="navigation-links" class="page-load d-md-flex">
        <div id="m-close-nav" class="d-md-none">
            <i id="close-navigation" class="fa fa-close fa-2x" onclick="handleNavigation('close')"></i>
        </div>

        @guest
            {{-- terms and conditions, about us pages missing --}}
            <li><a href="/" class="nav-item-link">Home</a></li>
            <li><a href="" class="nav-item-link">Contact Us</a></li>
            <li><a href="" class="nav-item-link">Donation</a></li>
            <li><a href="/login" class="nav-item-link">Login</a></li>
            <li><a href="/register" class="nav-item-link">Register</a></li>
        @endguest
        @auth
            <li><a href="/dashboard" class="nav-item-link">Home</a></li>
            <li onmouseout="closeAllPopUp()" onmouseover='togglePopup(this)' onclick="togglePopup(this)">
                <input type="checkbox" name="support" id="support" class="nav-button-toggle">
                <label for="support" class="nav-toggler nav-item-link">
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-caret-down"></i>
                        &nbsp;&nbsp;
                        <p class="m-0">Support</p>
                    </div>
                    <div class="popup pointer">
                        <div class="card border p-0 m-0 border-0 bg-transparent">
                            <div class="card-body p-0 m-0">
                                <ul class="list-group m-0 p-0">
                                    <li class="list-group-item list-group-item-action">
                                        <a href="" class="d-block nav-item-link">Contact Us</a>
                                    </li>
                                    <li class="list-group-item list-group-item-action">
                                        <a href="" class="d-block nav-item-link">Donation</a>
                                    </li>
                                    <li class="list-group-item list-group-item-action">
                                        <a href="" class="d-block nav-item-link">About Us</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </label>
            </li>
            <li onmouseout="closeAllPopUp()" onmouseover='togglePopup(this)' onclick="togglePopup(this)">
                <input type="checkbox" name="management" id="management" class="nav-button-toggle">
                <label for="management" class="nav-toggler nav-item-link">
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-caret-down"></i>
                        &nbsp;&nbsp;
                        <p class="m-0">Management</p>
                    </div>
                    <div id="management-popup" class="popup pointer">
                        <div class="card border border-0 p-0 m-0 bg-transparent">
                            <div class="card-body p-0 m-0">
                                <ul class="list-group m-0 p-0">
                                    <li class="list-group-item list-group-item-action">
                                        <a href="" class="nav-item-link">Eligibility Assessment</a>
                                    </li>
                                    <li class="list-group-item list-group-item-action">
                                        <a href="" class="nav-item-link">Food Safety</a>
                                    </li>
                                    <li class="list-group-item list-group-item-action">
                                        <a href="" class="nav-item-link">General Management</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </label>
            </li>
            <li><a href="{{ route('dashboard') }}" class="nav-item-link">Profile</a></li>
            <li onmouseout="closeAllPopUp()" onmouseover='togglePopup(this)' onclick="togglePopup(this)">
                <input type="checkbox" name="meals" id="meals" class="nav-button-toggle">
                <label for="meals" class="nav-toggler nav-item-link">
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-caret-down"></i>
                        &nbsp;&nbsp;
                        <p class="m-0">Meals</p>
                    </div>
                    <div class="popup pointer">
                        <div class="card border border-0 p-0 m-0 bg-transparent">
                            <div class="card-body p-0 m-0">
                                <ul class="list-group m-0 p-0">
                                    <li class="list-group-item list-group-item-action">
                                        <a href="" class="nav-item-link">Meals List</a>
                                    </li>
                                    <li class="list-group-item list-group-item-action">
                                        <a href="" class="nav-item-link">Meals Proposal</a>
                                    </li>
                                    <li class="list-group-item list-group-item-action">
                                        <a href="" class="nav-item-link">Orders</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </label>
            </li>
            <li><a href="/logout" class="nav-item-link">Logout</a></li>
        @endauth
    </ul>
</header>
<div id="nav-bg" class="d-none" onclick="handleNavigation('close')"></div>

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
        closeAllPopUp()
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
    function togglePopup(caller) {
        let navbox = caller.firstElementChild;
        navbox.nextElementSibling.firstElementChild.classList.add("fade");
        navbox.checked = true;
        navbox.nextElementSibling.firstElementChild.classList.remove('fade');
    }

    function closeAllPopUp() {
        const navButtons = document.getElementsByClassName("nav-button-toggle");
        for (const nav of navButtons) {
            nav.checked = false;
        }
    }
</script>

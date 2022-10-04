<div id="nav-bg" class="d-none" onclick="handleNavigation('close')"></div>

<header class="d-flex justify-content-between">
    <div class="logo">
        <img src="{{ Vite::asset('resources/images/logo.png') }}" class="rounded m-2 " alt="logo" height="50"
            width="50">
    </div>

    <i id="open-navigation" class="d-md-none fa fa-bars fa-2x m-3" onclick="handleNavigation('open')"></i>
    <ul id="navigation-links" class="page-load d-md-flex">
        <div id="m-close-nav" class="d-md-none">
            <i id="close-navigation" class="fa fa-close fa-2x" onclick="handleNavigation('close')"></i>
        </div>
        <li><a href="" class="d-block nav-item-link">Home</a></li>
        <li><a href="" class="d-block nav-item-link">Contact Us</a></li>
        <li><a href="" class="d-block nav-item-link">Donation</a></li>

        @if (Auth::hasUser())
            <li><a href="/logout" class="d-block nav-item-link">Logout</a></li>
        @else
            <li><a href="/login" class="d-block nav-item-link">Login</a></li>
            <li><a href="/register" class="d-block nav-item-link">Register</a></li>
        @endif
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
</script>

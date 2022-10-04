<div id="nav-bg" class="d-none" onclick="handleNavigation('close')"></div>
<ul id="m-navigation-links" class="page-load d-md-none">
    <div id="m-close-nav">
        <i id="close-navigation" class="fa fa-close fa-2x" onclick="handleNavigation('close')"></i>
    </div>
    <li><a href="" class="d-block nav-item-link">Home</a></li>
    <li><a href="" class="d-block nav-item-link">Contact Us</a></li>
    <li><a href="" class="d-block nav-item-link">Donation</a></li>
    <li><a href="/login" class="d-block nav-item-link">Login</a></li>
    <li><a href="/register" class="d-block nav-item-link">Register</a></li>
</ul>
<header class="d-flex justify-content-between">
    <div class="logo">
        <img src="{{ Vite::asset('resources/images/logo.png') }}" class="rounded m-2 " alt="logo" height="50"
            width="50">
    </div>
    <div class="d-flex align-items-center">
        <i id="open-navigation" class=" d-md-none fa fa-bars fa-2x m-3" onclick="handleNavigation('open')"></i>

        <ul id="navigation-links" class="d-none d-md-flex">
            <li><a href="" class="d-block nav-item-link">Home</a></li>
            <li><a href="" class="d-block nav-item-link">Contact Us</a></li>
            <li><a href="" class="d-block nav-item-link">Donation</a></li>
            <li><a href="/login" class="d-block nav-item-link">Login</a></li>
            <li><a href="/register" class="d-block nav-item-link">Register</a></li>
        </ul>
    </div>
</header>

<script>
    window.addEventListener("resize", () => {
        if (window.innerWidth > 767) {
            const navigation = document.getElementById("m-navigation-links");
            const bg = document.getElementById("nav-bg");

            bg.classList.remove('d-block')
            bg.classList.add('d-none')
            navigation.classList.remove("show-m-nav")
            navigation.classList.remove("close-m-nav")
        }
    })

    function handleNavigation(action) {
        const navigation = document.getElementById("m-navigation-links");
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

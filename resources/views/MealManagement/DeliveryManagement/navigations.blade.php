<nav>
    <ul class="nav nav-tabs border border-0">
        @HasAnyRole(['ROLE_MEMBER', 'ROLE_CARETAKER'])
        <li class="nav-item">
            <a class="
                nav-link
                @if (Request::url() == route('meals-list'))
                    active
                @endif"
                href="{{route('meals-list')}}"
            >
                 Meals
            </a>
        </li>
        <li class="nav-item">
            <a class="
                nav-link
                @if (Request::url() == route('mc-orders'))
                active
                @endif"
                href="{{route('mc-orders')}}"
            >
                Orders
            </a>
        </li>
        @EndHasAnyRoles
        @role('ROLE_ADMIN')
        <li class="nav-item">
            <a class="
                nav-link
                @if (Request::url() == route('a-prep-orders'))
                    active
                @endif"
                href="{{route('a-prep-orders')}}"
            >
                Assign Preparation
            </a>
        </li>
        <li class="nav-item">
            <a class="
                nav-link
                @if (Request::url() == route('a-del-orders'))
                active
                @endif"
                href="{{route('a-del-orders')}}"
            >
                Assign Delivery
            </a>
        </li>
        @endrole
        @HasAnyRole(['ROLE_VOLUNTEER_COOK', 'ROLE_PARTNER'])
            <li class="nav-item">
                <a class="
                    nav-link
                    @if (Request::url() == route('vp-prep-orders'))
                        active
                    @endif"
                    href="{{route('vp-prep-orders')}}"
                >
                    To Prepare
                </a>
            </li>
            <li class="nav-item">
                <a class="
                    nav-link
                    @if (Request::url() == route('vp-pack-orders'))
                    active
                    @endif"
                    href="{{route('vp-pack-orders')}}"
                >
                    To Package
                </a>
            </li>
        @EndHasAnyRoles
        @HasAnyRole(['ROLE_VOLUNTEER_RIDER','ROLE_PARTNER'])
        <li class="nav-item">
            <a class="
                nav-link
                @if (Request::url() == route('rp-del-orders'))
                    active
                @endif"
                href="{{route('rp-del-orders')}}"
            >
                To Deliver
            </a>
        </li>
        @EndHasAnyRoles
    </ul>
</nav>

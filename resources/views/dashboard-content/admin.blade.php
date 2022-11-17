<style>
    .card {
        margin: 10px 0px;
    }
</style>
<div class='border border-1 px-5 py-3'>
    <div class="d-flex justify-content-center flex-wrap">
        {{-- cards --}}
        <div class='mx-2 col-lg-2 col-md-4 col-sm-6 col-12 card' style="height: 21rem">
            <div class='card-header p-0 bg-transparent d-flex justify-content-center'>
                <img src="{{ Vite::asset('resources/images/icons/user icon.png') }}" class="p-2 m-2" alt="user icon"
                    style="height:10rem; width:10rem;" loading="lazy" />
            </div>
            <div class="card-body d-flex flex-column">
                <span class="d-block text-center">Total Members</span>
                <span id="member" class="d-block text-center"></span>
            </div>
            <div class="card-footer border border-0 bg-transparent">
                <a href="/user-management?view=Members" class="btn btn-primary w-100">
                    View All
                </a>
            </div>
        </div>
        <div class='mx-2 col-lg-2 col-md-4 col-sm-6 col-12 card' style="height: 21rem">
            <div class='card-header p-0 bg-transparent d-flex justify-content-center'>
                <img src="{{ Vite::asset('resources/images/icons/user icon.png') }}" class="p-2 m-2" alt="user icon"
                    style="height:10rem; width:10rem;" loading="lazy" />
            </div>
            <div class="card-body d-flex flex-column">
                <span class="d-block text-center">Total Caregivers</span>
                <span id="caregiver" class="d-block text-center"></span>
            </div>
            <div class="card-footer border border-0 bg-transparent">
                <a href="/user-management?view=Caregivers" class="btn btn-primary w-100">
                    View All
                </a>
            </div>
        </div>
        <div class='mx-2 col-lg-2 col-md-4 col-sm-6 col-12 card' style="height: 21rem">
            <div class='card-header p-0 bg-transparent d-flex justify-content-center'>
                <img src="{{ Vite::asset('resources/images/icons/user icon.png') }}" class="p-2 m-2" alt="user icon"
                    style="height:10rem; width:10rem;" loading="lazy" />
            </div>
            <div class="card-body d-flex flex-column">
                <span class="d-block text-center">Total Partners</span>
                <span id="partner" class="d-block text-center"></span>
            </div>
            <div class="card-footer border border-0 bg-transparent">
                <a href="/user-management?view=Partner" class="btn btn-primary w-100">
                    View All
                </a>
            </div>
        </div>
        <div class='mx-2 col-lg-2 col-md-4 col-sm-6 col-12 card' style="height: 21rem">
            <div class='card-header p-0 bg-transparent d-flex justify-content-center'>
                <img src="{{ Vite::asset('resources/images/icons/user icon.png') }}" class="p-2 m-2" alt="user icon"
                    style="height:10rem; width:10rem;" loading="lazy" />
            </div>
            <div class="card-body d-flex flex-column">
                <span class="d-block text-center">Total Volunteers</span>
                <span id="volunteer" class="d-block text-center"></span>
            </div>
            <div class="card-footer border border-0 bg-transparent">
                <a href="/user-management?view=Volunteers" class="btn btn-primary w-100">
                    View All
                </a>
            </div>
        </div>
        <div class='mx-2 col-lg-2 col-md-4 col-sm-6 col-12 card' style="height: 21rem">
            <div class='card-header p-0 bg-transparent d-flex justify-content-center'>
                <img src="{{ Vite::asset('resources/images/icons/pending icon.png') }}" class="p-2 m-2" alt="user icon"
                    style="height:10rem; width:10rem;" loading="lazy" />
            </div>
            <div class="card-body d-flex flex-column">
                <span class="d-block text-center">Pending Registrations</span>
                <span id="registration" class="d-block text-center"></span>
            </div>
            <div class="card-footer border border-0 bg-transparent">
                <a href="{{ route('member-assessment') }}" class="btn btn-primary w-100">
                    View All
                </a>
            </div>
        </div>
        <div class='mx-2 col-lg-2 col-md-4 col-sm-6 col-12 card' style="height: 21rem">
            <div class='card-header p-0 bg-transparent d-flex justify-content-center'>
                <img src="{{ Vite::asset('resources/images/icons/food icon.png') }}" class="p-2 m-2" alt="user icon"
                    style="height:10rem; width:10rem;" loading="lazy" />
            </div>
            <div class="card-body d-flex flex-column">
                <span class="d-block text-center">Pending Food Assessment</span>
                <span id="food_assessment" class="d-block text-center"></span>
            </div>
            <div class="card-footer border border-0 bg-transparent">
                <a href="{{ route('food-assessment') }}" class="btn btn-primary w-100">
                    View All
                </a>
            </div>
        </div>
        <div class='mx-2 col-lg-2 col-md-4 col-sm-6 col-12 card' style="height: 21rem">
            <div class='card-header p-0 bg-transparent d-flex justify-content-center'>
                <img src="{{ Vite::asset('resources/images/icons/Order icon.png') }}" class="p-2 m-2" alt="user icon"
                    style="height:10rem; width:10rem;" loading="lazy" />
            </div>
            <div class="card-body d-flex flex-column">
                <span class="d-block text-center">Pending Orders</span>
                <span id="orders" class="d-block text-center"></span>
            </div>
            <div class="card-footer border border-0 bg-transparent">
                <a href="{{ route('a-prep-orders') }}" class="btn btn-primary w-100">
                    View All
                </a>
            </div>
        </div>
        <div class='mx-2 col-lg-2 col-md-4 col-sm-6 col-12 card' style="height: 21rem">
            <div class='card-header p-0 bg-transparent d-flex justify-content-center'>
                <img src="{{ Vite::asset('resources/images/icons/pending delivery.png') }}" class="p-2 m-2"
                    alt="user icon" style="height:10rem; width:10rem;" loading="lazy" />
            </div>
            <div class="card-body d-flex flex-column">
                <span class="d-block text-center">Pending Delivery</span>
                <span id="delivery" class="d-block text-center"></span>
            </div>
            <div class="card-footer border border-0 bg-transparent">
                <a href="{{ route('a-del-orders') }}" class="btn btn-primary w-100">
                    View All
                </a>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', async () => {
        const details = await fetch('http://localhost:8000/total-entities')
        const apply = await details.json();
        Object.entries(apply).forEach(([key, value]) => {
            assignValues(key, value);
        });
    });

    function assignValues(targetElement, data) {
        document.querySelector('#' + targetElement).innerHTML = data;
    }
</script>

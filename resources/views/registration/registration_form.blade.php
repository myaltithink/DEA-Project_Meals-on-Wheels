<form
    action="
                    @if (Request::is('register-member')) {{ route('register.member') }}
                    @elseif (Request::is('register-caregiver'))
                    {{ route('register.caregiver') }}
                    @elseif (Request::is('register-partner'))
                    {{ route('register.partner') }}
                    @elseif (Request::is('register-volunteer'))
                    {{ route('register.volunteer') }} @endif
                "
    method="POST" id="registration-form" class="form-group" enctype="multipart/form-data">

    @yield('registration-form')
    <div class="left-padding mt-2">
        <div class="">
            <button type="submit" id="submit-registration" class="btn btn-primary w-100 disabled">Submit</button>
        </div>
    </div>

    <input type="hidden" name="latitude" id="latitude">
    <input type="hidden" name="longtitude" id="longtitude">
    @csrf
</form>

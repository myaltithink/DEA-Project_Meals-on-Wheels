<div id='account-section' class=" @if (!Request::is('login')) left-padding @endif">

    @if (!Request::is('login'))
        <h4 class="m-0">Account</h4>
    @endif

    <div class="form-control border-0 mb-2 p-0">
        <label for="email">Email
            @if (!Request::is('login'))
                <i class="required"><small>(required)</small></i>
            @endif
        </label>
        <input type="email" name="email" id="email" class="form-control mb-0" value="{{ old('email', '') }}" />
        <small class="error-message"></small>
    </div>

    <div class="form-control border-0 mb-2 p-0">
        <label for="password">Password
            @if (!Request::is('login'))
                <i class="required"><small>(required)</small></i>
            @endif
        </label>
        <div class="pass-input d-flex form-control p-0 mb-0">
            <input type="password" name="password" id="password" class="form-control border-0 mb-0" />
            <button type="button" class="btn show-pass"><i class="pass-state-icon fa fa-eye-slash"></i></button>
        </div>
        <small class="error-message"></small>
    </div>

    @if (!Request::is('login'))
        <div class="form-control border-0 mb-2 p-0">
            <label for="confirm-pass">Confirm Password <i class="required"><small>(required)</small></i></label>
            <div class="pass-input d-flex form-control p-0 mb-0">
                <input type="password" name="confirm-pass" id="confirm-pass" class="form-control border-0 mb-0" />
                <button type="button" class="btn show-pass"><i class="pass-state-icon fa fa-eye-slash"></i></button>
            </div>
            <small class="error-message"></small>
        </div>
    @endif


</div>
@push('scripts')
    @vite(['resources/js/login-registration.js'])
@endpush

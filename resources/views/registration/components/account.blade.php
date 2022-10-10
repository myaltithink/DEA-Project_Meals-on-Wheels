<div class="left-padding">

    <h4 class="m-0">Account</h4>

    <div class="form-control border-0 mb-0 p-0">
        <label for="email">Email</label>
        <input type="text" name="email" class="form-control mb-0" />
        <small class="error-message"></small>
    </div>

    <div class="form-control border-0 mb-0 p-0">
        <label for="password">Password</label>
        <div class="pass-input d-flex form-control p-0">
            <input type="password" name="password" class="form-control border-0 mb-0" />
            <button type="button" class="btn show-pass"><i class="pass-state-icon fa fa-eye-slash"></i></button>
        </div>
        <small class="error-message"></small>
    </div>

    <div class="form-control border-0 mb-0 p-0">
        <label for="confirm-pass">Confirm Password</label>
        <div class="pass-input d-flex form-control p-0">
            <input type="password" name="confirm-pass" class="form-control border-0 mb-0" />
            <button type="button" class="btn show-pass"><i class="pass-state-icon fa fa-eye-slash"></i></button>
        </div>
        <small class="error-message"></small>
    </div>

</div>
@push('scripts')
    @vite(['resources/js/login-registration.js'])
@endpush

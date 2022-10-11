<div id="identity-section" class="form-control left-padding border-0">
    <h4 class="m-0">Identity</h4>

    @if (!Request::is('register-partner'))
        <label for="valid-id">Valid Id <i class="required"><small>(required)</small></i></label>
        <input class="form-control mb-0" name="valid-id" id="valid-id" type="file"
            accept="image/png, image/gif, image/jpeg" />
        <small class="error-message"></small><br>
    @endif


    @if (Request::is('register-member'))
        <label for="member-eligibility">Proof of Eligibility <i class="required"><small>(required)</small></i></label>
        <input class="form-control mb-0" name="member-eligibility" id="member-eligibility" type="file"
            accept="image/png, image/gif, image/jpeg" />
        <small class="error-message"></small><br>
    @endif

    @if (Request::is('register-partner'))
        <label for="business-license">Business License <i class="required"><small>(required)</small></i></label>
        <input class="form-control mb-0" name="business-license" id="business-license" type="file"
            accept="image/png, image/gif, image/jpeg" />
        <small class="error-message"></small><br>
        <p style="font-size: 14px">If your organization does't have a business license, consider registering as a
            volunteer</p>
    @endif

</div>

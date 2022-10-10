<div id="identity-section" class="form-control left-padding border-0">
    <h4 class="m-0">Identity</h4>

    @if (!Request::is('register-partner'))
        <label for="valid-id">Valid Id</label>
        <input class="form-control" name="valid-id" type="file" accept="image/png, image/gif, image/jpeg" />
    @endif


    @if (Request::is('register-member'))
        <label for="member-eligibility">Proof of Eligibility</label>
        <input class="form-control" name="member-eligibility" type="file" accept="image/png, image/gif, image/jpeg" />
    @endif

    @if (Request::is('register-partner'))
        <label for="business-license">Business License</label>
        <input class="form-control mb-0" name="business-license" type="file"
            accept="image/png, image/gif, image/jpeg" />
        <p style="font-size: 14px">If your organization does't have a business license, consider registering as a
            volunteer</p>
    @endif

</div>

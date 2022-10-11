<div class="form-control left-padding border-0 pb-0">
    <h4 class="m-0">Profile</h4>

    <div class="basic-profile-info mb-2">
        <div class="first-name">
            <label for="first-name">First Name <i class="required"><small>(required)</small></i></label>
            <input type="text" class="form-control mb-0" id="first-name" name="first-name" />
            <small class="error-message"></small>
        </div>
        <div class="last-name">
            <label for="last-name">Last Name <i class="required"><small>(required)</small></i></label>
            <input type="text" class="form-control mb-0" id="last-name" name="last-name">
            <small class="error-message"></small>
        </div>
    </div>
    <div class="basic-profile-info">
        <div class="age">
            <label for="age">Age <i class="required"><small>(required)</small></i></label>
            <input type="text" class="form-control mb-0" id="age" name="age" />
            <small class="error-message"></small>
        </div>
        <div class="birthday">
            <label for="birthday">Birthday <i class="required"><small>(required)</small></i></label>
            <input type="date" class="form-control mb-0" id="birthday" name="birthday">
            <small class="error-message"></small>
        </div>
    </div>

    <div id="gender-selection" class="mt-2 mb-2">
        <label for="gender">Gender <i class="required"><small>(required)</small></i></label>
        <div class="d-block">
            <input type="radio" name="gender" id="male" value="Male">
            <label for="male">Male</label>
        </div>

        <div class="d-block">
            <input type="radio" name="gender" id="female" value="Female">
            <label for="female">Female</label>
        </div>
        <div class="d-block">
            <input type="radio" name="gender" id="N/A" value="Would rather not say">
            <label for="N/A">Would rather not say</label>
        </div>
    </div>

    <div id="contact-info" class="mb-2">
        <label for="contact-num">Contact # <i class="required"><small>(required)</small></i></label>
        <input type="text" name="contact-num" id="contact" class="form-control mb-0">
        <small class="error-message"></small>
    </div>

    <div id="address">
        <label for="address">Address <i class="required"><small>(required)</small></i></label>
        <input type="text" name="address" id="address" class="form-control mb-0">
        <small class="error-message"></small>
    </div>

</div>

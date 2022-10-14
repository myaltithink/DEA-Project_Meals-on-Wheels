const emailRegex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
const numberRegex = /^[0-9]*$/;
const emptyRegex = /^\s*$/;

let form = document.getElementById('registration-form');

if (window.location.pathname.includes('new-pass')) {
    form = document.getElementById('new-password-form')
}

if (window.location.pathname.includes('register-')) {
    window.addEventListener('load', getLocation);
}

form.addEventListener('input', validateForm);


console.log(document.getElementsByClassName('show-pass'))

for (const showPassBtn of document.getElementsByClassName('show-pass')) {
    showPassBtn.addEventListener('click', showPass);
}

function getLocation(e) {
    console.log(e)
    if (navigator.geolocation) {
        console.log('geo location')
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        console.log('geo location not supported')
        alert("Geolocation is not supported by this browser.\nGeolocation is required to register");
    }
}

function showPosition(position) {
    console.log(position);
    const latitude = document.getElementById('latitude');
    const longtitude = document.getElementById('longtitude');

    latitude.value = position.coords.latitude;
    longtitude.value = position.coords.longitude;
}

function showError(error) {
    switch (error.code) {
        case error.PERMISSION_DENIED:
            alert("Request for Geolocation has been denied\nGeolocation is required to register");
            break;
        case error.POSITION_UNAVAILABLE:
            alert("Location information is unavailable.")
            break;
        case error.TIMEOUT:
            alert("The request to get user location timed out.")
            break;
        case error.UNKNOWN_ERROR:
            alert("An unknown error occurred.")
            break;
    }
}

function validateForm(e) {
    const input = e.target;
    let button = document.getElementById('submit-registration')

    if (window.location.pathname.includes('new-pass')) {
        button = document.getElementById('submit-new-pass')
    }

    let valid = true;

    for (const className of input.classList) {
        if (className == 'nullable') {
            return;
        }
    }

    if (emptyRegex.test(input.value)) {
        setErrorMessage(input, 'This field is required')
    } else {
        if (input.name != 'gender' && input.type != 'checkbox') {
            setErrorMessage(input, '');
        }
    }

    if (input.type == 'email') {
        if (emailRegex.test(input.value)) {
            setErrorMessage(input, '')
        } else {
            setErrorMessage(input, 'Invalid Email Address')
        }
    }

    if (input.id == 'age') {
        if (numberRegex.test(input.value)) {
            setErrorMessage(input, '')
        } else {
            setErrorMessage(input, 'Invalid Age Value')
        }
    }

    if (input.id == 'password' || input.id == 'confirm-pass') {
        const passInput = document.getElementsByName("password")[0];
        const confirmPassInput = document.getElementsByName("confirm-pass")[0];

        if (passInput.value.length < 8) {
            setErrorMessage(passInput, 'Password is too short')
        } else if (passInput.value != confirmPassInput.value) {
            setErrorMessage(passInput, 'Password does not match')
        } else {
            setErrorMessage(passInput, '')
        }
    }

    let genderSelected = false;
    for (const radio of document.getElementsByName('gender')) {
        if (radio.checked) {
            genderSelected = true;
            break;
        }
    }

    let volunteerRoleSelected = false;
    if (window.location.pathname.split('-')[1] == 'volunteer') {
        const cookRole = document.getElementById('volunteer-kitchen');
        const riderRole = document.getElementById('volunteer-rider');
        volunteerRoleSelected = cookRole.checked || riderRole.checked
    }

    for (const formInput of form) {

        let nullableInput = false;
        for (const className of formInput.classList) {
            if (className == 'nullable') {
                nullableInput = true;
                break;
            }
        }

        if (nullableInput) continue;

        if (formInput.type != 'submit' && formInput.type != 'hidden' && formInput.type != 'button') {

            if (emptyRegex.test(formInput.value) && formInput.name != 'gender' && formInput.type != 'checkbox') {
                valid = false;
                break;
            }

            if (formInput.name == 'volunteer-kitchen' || formInput.name == 'volunteer-rider') {
                if (!volunteerRoleSelected) {
                    valid = false;
                    break;
                }
            }

            if (formInput.name == 'gender') {
                if (!genderSelected) {
                    valid = false;
                    break;
                }
            }

            if (formInput.type == 'email') {
                if (!emailRegex.test(formInput.value)) {
                    valid = false;
                    break;
                }
            }

            if (formInput.id == 'age') {
                if (!numberRegex.test(formInput.value)) {
                    valid = false;
                    break;
                }
            }

            if (formInput.id == 'password' || formInput.id == 'confirm-pass') {
                const passInput = document.getElementsByName("password")[0];
                const confirmPassInput = document.getElementsByName("confirm-pass")[0];

                if (passInput.value.length < 8) {
                    valid = false;
                    break;
                }

                if (passInput.value != confirmPassInput.value) {
                    valid = false;
                    break;
                }
            }

        }

    }

    (valid)? button.classList.remove('disabled') : button.classList.add('disabled');

}

function setErrorMessage(input, message) {
    let errorMessage = input.nextElementSibling;

    if (input.name == 'password' || input.name == "confirm-pass") {
        errorMessage = input.parentElement.nextElementSibling;
    }
    errorMessage.innerText = message;
}

function showPass() {
    const passInput = document.getElementsByName("password")[0];
    const confirmPassInput = document.getElementsByName("confirm-pass")[0];
    const showIcon = document.getElementsByClassName("pass-state-icon")

    if (passInput.type == "text") {
        handlePasswordIcons([passInput, confirmPassInput], 'password', showIcon, 'fa-eye', 'fa-eye-slash');
        return;
    }
    handlePasswordIcons([passInput, confirmPassInput], 'text', showIcon, 'fa-eye-slash', 'fa-eye');
}

function handlePasswordIcons(inputs, inputType, icons, removeClass, addClass) {
    inputs[0].type = inputType;
    icons[0].classList.remove(removeClass);
    icons[0].classList.add(addClass);

    if (window.location.pathname == '/login') return;

    inputs[1].type = inputType;
    icons[1].classList.remove(removeClass);
    icons[1].classList.add(addClass);
}

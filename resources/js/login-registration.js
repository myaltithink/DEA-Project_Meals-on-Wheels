
for (const button of document.getElementsByClassName('show-pass')) {
    button.addEventListener('click', showPass);
}

function showPass() {
	const passInput = document.getElementsByName("password")[0];
	const confirmPassInput = document.getElementsByName("confirm-pass")[0];
	const showIcon = document.getElementsByClassName("pass-state-icon")

	if (passInput.type == "text") {
		passInput.type = "password";
		showIcon[0].classList.remove("fa-eye");
		showIcon[0].classList.add("fa-eye-slash");

		confirmPassInput.type = "password";
		showIcon[1].classList.remove("fa-eye")
		showIcon[1].classList.add("fa-eye-slash");
	} else {
		passInput.type = "text";
		showIcon[0].classList.remove("fa-eye-slash");
		showIcon[0].classList.add("fa-eye");

		confirmPassInput.type = "text";
		showIcon[1].classList.add("fa-eye");
		showIcon[1].classList.remove("fa-eye-slash");
	}

}

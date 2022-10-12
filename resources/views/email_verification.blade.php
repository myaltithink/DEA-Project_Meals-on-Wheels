<style>
    #email-verification {
        margin-left: 20px;
    }

    #email-verification #verification-code {
        font-size: 20px;
    }
</style>

<div id="email-verification">
    <h3>Meals on Wheels Email Verification</h3>

    @if ($is_registration)
        <p>Welcome to Meals on Wheels brought you by MerryMeals</p>
        <p>You have successfully registered and will need to confirm your email address</p>
        <p>by entering the verification code below</p>
    @endif

    @if ($is_forget_pass)
        <p>Your request for Password Reset has been process</p>
        <p>Verify that it was you by entering the email verification code below</p>
    @endif

    <p id="verification-code">Verification Code: <b>{{ $verification_code }}</b></p>

</div>

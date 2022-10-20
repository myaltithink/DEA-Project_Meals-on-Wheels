<div>
    <h3>Meals on Wheels Registration Update</h3>

    @if($approve)
        <p>Good day!</p><br/>
        <p>This is the administrator of Meal on Wheels.</p><br/>
        <p>After reviewing the information you have submitted in the registration form, gladly, it is concluded that you are eligible for using our service.</p><br/>
        <p>Welcome to the Meals on Wheals! You can now login with your account and use our service.</p><br/>
        <p>If you have any queries, do not hesitate to contact us. You can reach us through our contact us page and our socials.</p><br/>
        <p>Stay safe and God bless!</p><br/>
    @endif

    @if(!$approve)
        <p>Good day!</p><br/>
        <p>This is the administrator of Meal on Wheels.</p><br/>
        <p>After reviewing the information you have submitted in the registration form, unfortunately, it is concluded that you are ineligible for using our service.</p><br/>
        <p>For the reason of: {{ ucfirst($reason) }}</p><br/>
        <p>However, you are still allowed to register on our website with the updated information.</p><br/>
        <p>If you have any queries, do not hesitate to contact us. You can reach us through our contact us page and our socials.</p><br/>
        <p>Stay safe and God bless!</p><br/>
    @endif


</div>

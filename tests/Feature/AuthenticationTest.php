<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

class AuthenticationTest extends TestCase
{
    public function test_password_matching()
    {
        //correct password is "wasdwasd"
        $user = User::where('email', 'tarucisaac@gmail.com')->get()[0];

        //registration uses bcrypt algorithm to encrypt the registration password
        //then uses Hash::check to validate whether the password was incorrect
        //incase the authentication failed
        $correct_matching = Hash::check('wasdwasd', $user->password);
        $incorrect_matching = Hash::check('wasdwasd2', $user->password);

        assertTrue($correct_matching);
        assertFalse($incorrect_matching);
    }

    public function test_email_not_registered()
    {
        $response = $this->post(
            '/perform-login',
            [
                "email" => 'taruc2@gmail.com',
                'password' => 'wasdwasd'
            ]
        );
        $response->assertSessionHas('email_error', 'email address is not registered');
    }

    public function test_wrong_password()
    {
        //email is an actual data from database
        //and the correct password is 'wasdwasd'
        $response = $this->post(
            '/perform-login',
            [
                "email" => 'tarucisaac@gmail.com',
                'password' => 'wrong password'
            ]
        );
        $response->assertSessionHas('password_error', 'Wrong Password');
    }

    //every authentication only has one redirection which is the /dashboard which uses
    //the user roles to render contents accordingly.
    //
    //therefore in order to test whether the user is being redirected correctly
    //we are checking whether the authenticated user has the correct role.
    public function test_login_as_member_and_as_caregiver()
    {
        $member_response = $this->post(
            '/perform-login',
            [
                "email" => 'member@gmail.com',
                'password' => 'wasdwasd'
            ]
        );

        $member_auth = Auth::user();
        assertEquals('ROLE_MEMBER', $member_auth->roles[0]->role_name);
        $member_response->assertRedirect(route('dashboard'));

        Auth::logout();

        $caregiver_response = $this->post(
            '/perform-login',
            [
                "email" => 'caregiver@gmail.com',
                'password' => 'wasdwasd'
            ]
        );
        $caregiver_auth = Auth::user();
        assertEquals('ROLE_CAREGIVER', $caregiver_auth->roles[0]->role_name);
        $caregiver_response->assertRedirect(route('dashboard'));
    }


    //every authentication only has one redirection which is the /dashboard which uses
    //the user roles to render contents accordingly.
    //
    //therefore in order to test whether the user is being redirected correctly
    //we are checking whether the authenticated user has the correct role.
    public function test_login_as_partner_and_as_volunteer()
    {
        $partner_response = $this->post(
            '/perform-login',
            [
                "email" => 'partner@gmail.com',
                'password' => 'wasdwasd'
            ]
        );

        $partner_auth = Auth::user();
        assertEquals('ROLE_PARTNER', $partner_auth->roles[0]->role_name);
        $partner_response->assertRedirect(route('dashboard'));

        Auth::logout();

        $volunteer_response = $this->post(
            '/perform-login',
            [
                "email" => 'volunteer@gmail.com',
                'password' => 'wasdwasd'
            ]
        );
        $volunteer_auth = Auth::user();
        Log::info(print_r($volunteer_auth->roles[1], true));

        assertEquals('ROLE_VOLUNTEER', $volunteer_auth->roles[0]->role_name);
        $volunteer_response->assertRedirect(route('dashboard'));
    }
}

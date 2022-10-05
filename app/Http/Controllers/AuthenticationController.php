<?php

namespace App\Http\Controllers;

use App\Models\CaregiverDetails;
use App\Models\MemberDetails;
use App\Models\PartnerDetails;
use App\Models\Profile;
use App\Models\RegistrationData;
use App\Models\Role;
use App\Models\User;
use App\Models\user_roles;
use App\Models\VolunteerDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthenticationController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        Log::info("credentials " . print_r($credentials, true));

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            foreach ($user->roles as $role) {
                Log::info('user role ' . print_r($role['role_name'], true));
            }

            return redirect('/dashboard');
        }

        return redirect('/login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }

    public function create_auth_test_data()
    {
        $member_test_data = array(
            //profile info
            'first_name' => 'Member',
            'last_name' => 'Name',
            'age' => '19',
            'birthday' => '2003-06-03',
            'gender' => 'male',
            'contact_number' => '123-123-123',
            'address' => '6969 street 420',
            'valid_id' => 'test id',

            //member data
            'needs' => 'some needs',
            'allergies' => 'some allergies',
            'proof_of_eligebility' => 'test eligibility',

            //account data
            'email' => 'member@gmail.com',
            'password' => bcrypt('wasdwasd'),
            'longtitude' => '12.2345',
            'latitude' => '8.2146',
            'status' => 'Waiting For Approval'
        );

        $caregiver_test_data = array(
            //profile info
            'first_name' => 'Caregiver',
            'last_name' => 'Name',
            'age' => '19',
            'birthday' => '2003-06-03',
            'gender' => 'male',
            'contact_number' => '123-123-123',
            'address' => '6969 street 420',
            'valid_id' => 'test id',

            //caregiver data
            'assigned_member_name' => 'Member Name',
            'assigned_member_email' => 'member@gmail.com',

            //account info
            'email' => 'caregiver@gmail.com',
            'password' => bcrypt('wasdwasd'),
            'longtitude' => '11.2345',
            'latitude' => '9.2146',
            'status' => 'Waiting For Approval'
        );

        $partner_test_data = array(
            //partner data
            'partner_name' => 'HABOL Corp',
            'partner_registered_by' => 'test_employee@gmail.com',
            'partner_address' => '234 wasddfg',
            'partner_business_license' => 'some license link',

            //account info
            'email' => 'partner@gmail.com',
            'password' => bcrypt('wasdwasd'),
            'longtitude' => '9.2345',
            'latitude' => '8.2146',
            'status' => 'Waiting For Approval'
        );

        $volunteer_test_data = array(
            //profile info
            'first_name' => 'Volunteer',
            'last_name' => 'Name',
            'age' => '19',
            'birthday' => '2003-06-03',
            'gender' => 'male',
            'contact_number' => '123-123-123',
            'address' => '6969 street 420',
            'valid_id' => 'test id',

            //volunteer data
            'volunteer_name' => 'Volunteer Name',
            'volunteer_role' => 'Outsource Kitchen',
            'organization_name' => 'Some Org',
            'organization_address' => '1234 org address',

            //account info
            'email' => 'volunteer@gmail.com',
            'password' => bcrypt('wasdwasd'),
            'longtitude' => '16.2345',
            'latitude' => '8.2146',
            'status' => 'Waiting For Approval'
        );

        $rider_test_data = array(
            //profile info
            'first_name' => 'Rider',
            'last_name' => 'Name',
            'age' => '19',
            'birthday' => '2003-06-03',
            'gender' => 'male',
            'contact_number' => '123-123-123',
            'address' => '6969 street 420',
            'valid_id' => 'test id',

            //volunteer data
            'volunteer_name' => 'Rider Name',
            'volunteer_role' => 'Rider',
            'organization_name' => 'Some Org',
            'organization_address' => '1234 org address',

            //account info
            'email' => 'rider@gmail.com',
            'password' => bcrypt('wasdwasd'),
            'longtitude' => '6.2345',
            'latitude' => '8.2146',
            'status' => 'Waiting For Approval'
        );

        //member registration
        $member_account = new User();
        $member_account->fill($member_test_data)->save();
        $member_account->roles()->attach(Role::where('role_name', 'ROLE_MEMBER')->get()[0]['id']);
        $member_data = new MemberDetails();
        $member_data->fill($member_test_data);
        $member_profile = new Profile();
        $member_profile->fill($member_test_data);
        $member_account
            ->member_details()->save($member_data)
            ->profile()->save($member_profile);

        //caregiver registration
        $caregiver_account = new User();
        $caregiver_account->fill($caregiver_test_data)->save();
        $caregiver_account->roles()->attach(Role::where('role_name', 'ROLE_CAREGIVER')->get()[0]['id']);
        $caregiver_data = new CaregiverDetails();
        $caregiver_data->fill($caregiver_test_data);
        $caregiver_profile = new Profile();
        $caregiver_profile->fill($caregiver_test_data);
        $caregiver_account
            ->caregiver_details()->save($caregiver_data)
            ->profile()->save($caregiver_profile);

        //volunteer registration
        $volunteer_account = new User();
        $volunteer_account->fill($volunteer_test_data)->save();
        $volunteer_account->roles()->attach([
            Role::where('role_name', 'ROLE_VOLUNTEER')->get()[0]['id'],
            Role::where('role_name', 'ROLE_VOLUNTEER_COOK')->get()[0]['id']
        ]);
        $volunteer_data = new VolunteerDetails();
        $volunteer_data->fill($volunteer_test_data);
        $volunteer_profile = new Profile();
        $volunteer_profile->fill($volunteer_test_data);
        $volunteer_account
            ->volunteer_details()->save($volunteer_data)
            ->profile()->save($volunteer_profile);

        //rider registration
        $rider_account = new User();
        $rider_account->fill($rider_test_data)->save();
        $rider_account->roles()->attach([
            Role::where('role_name', 'ROLE_VOLUNTEER')->get()[0]['id'],
            Role::where('role_name', 'ROLE_VOLUNTEER_RIDER')->get()[0]['id']
        ]);
        $rider_data = new VolunteerDetails();
        $rider_data->fill($rider_test_data);
        $rider_profile = new Profile();
        $rider_profile->fill($rider_test_data);
        $rider_account
            ->volunteer_details()->save($rider_data)
            ->profile()->save($rider_profile);



        //partner registration
        $partner_account = new User();
        $partner_account->fill($partner_test_data)->save();
        $partner_account->roles()->attach(Role::where('role_name', 'ROLE_PARTNER')->get()[0]['id']);
        $partner_data = new PartnerDetails();
        $partner_data->fill($partner_test_data);
        $partner_account->partner_details()->save($partner_data);
    }


    public function register(Request $request)
    {
        //return redirect('/');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\CaregiverDetails;
use App\Models\EmailVerification;
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
use Illuminate\Support\Facades\Mail;

class AuthenticationController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

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

    public function save_image(Request $request)
    {
        $uploaded_dir = FileUploadController::upload_file($request->file('file_input'), 'test new uploade', 'new destination');

        Log::info('saved dir ' . $uploaded_dir);
    }

    public function send_registration_email_verification($email)
    {
        $verification_type = 'registration';
        $verification_code = MailController::create_verification_code('registration');

        $duplicate = EmailVerification::where([
            ['email', '=', $email],
            ['verification_type', '=', $verification_type]
        ])->get();

        Log::info("duplicate " . print_r($duplicate, true));

        if ($duplicate->count() != 0) {
            $duplicate[0]->delete();
        }

        $verification_entity = new EmailVerification([
            'email' => $email,
            'verification_type' => $verification_type,
            'verification_code' => $verification_code
        ]);
        $verification_entity->save();

        MailController::send_email('tarucisaac@gmail.com', 'Isaac Taruc', 'Registration Verification', $verification_type, $verification_code);

        return redirect(route('email_verification'))->with('email', $email);
    }

    private function get_registration_profile(Request $request)
    {
        return new Profile([
            'first_name' => $request['first-name'],
            'last_name' => $request['last-name'],
            'age' => $request['age'],
            'gender' => $request['gender'],
            'birthday' => $request['birthday'],
            'contact_number' => $request['contact-num'],
            'address' => $request['address'],
            'valid_id' => FileUploadController::upload_file($request['valid-id'], $request['email'] . '-valid-id', 'valid_ids'),
        ]);
    }

    private function get_registration_acc_data(Request $request)
    {
        return array(
            'email' => $request['email'],
            'password' => $request['password'],
            'longtitude' => $request['longtitude'],
            'latitude' => $request['latitude'],
            'status' => 'Waiting for Email Verification from User'
        );
    }

    public function member_registration(Request $request)
    {
        $user = new User();
        $user->fill($this->get_registration_acc_data($request))->save();
        $user->roles()->attach(Role::where('role_name', 'ROLE_MEMBER')->get()[0]['id']);

        $member_details = new MemberDetails([
            'proof_of_eligebility' => FileUploadController::upload_file($request->file('member-eligibility'), $request['email'] . '-proof', 'member_eligibilities'),
            'needs' => $request['needs'],
            'allergies' => $request['allergies']
        ]);

        $user
            ->member_details()->save($member_details)
            ->profile()->save($this->get_registration_profile($request));

        $this->send_registration_email_verification($user->getAttribute('email'));
    }

    public function caregiver_registration(Request $request)
    {
        $user = new User();
        $user->fill($this->get_registration_acc_data($request))->save();
        $user->roles()->attach(Role::where('role_name', 'ROLE_CAREGIVER')->get()[0]['id']);

        $caregiver_data = new CaregiverDetails([
            'assigned_member_name' => $request['member-name'],
            'assigned_member_email' => $request['member-email']
        ]);

        $user
            ->caregiver_details()->save($caregiver_data)
            ->profile()->save($this->get_registration_profile($request));

        $this->send_registration_email_verification($user->getAttribute('email'));
    }

    public function partner_registration(Request $request)
    {
        $user = new User();
        $user->fill($this->get_registration_acc_data($request))->save();
        $user->roles()->attach(Role::where('role_name', 'ROLE_PARTNER')->get()[0]['id']);

        $partner_data = new PartnerDetails([
            'partner_name' => $request['company-name'],
            'partner_registered_by' => $request['registered-by'],
            'partner_address' => $request['partner-address'],
            'partner_business_license' => FileUploadController::upload_file($request->file('business-license'), $request['company-name'] . 'business-license', 'partner_business_license')
        ]);

        $user->partner_details()->save($partner_data);

        $this->send_registration_email_verification($user->getAttribute('email'));
    }
    public function volunteer_registration(Request $request)
    {
        $empty_regex = "/^\s*$/i";

        $user = new User();
        $user->fill($this->get_registration_acc_data($request))->save();
        $user->roles()->attach(Role::where('role_name', 'ROLE_VOLUNTEER')->get()[0]['id']);

        $volunteer_role = '';

        if (!preg_match($empty_regex, $request['volunteer-rider'])) {
            $user->roles()->attach(Role::where('role_name', 'ROLE_VOLUNTEER_RIDER')->get()[0]['id']);
            $volunteer_role = 'Rider';
        }

        if (!preg_match($empty_regex, $request['volunteer-kitchen'])) {
            $user->roles()->attach(Role::where('role_name', 'ROLE_VOLUNTEER_COOK')->get()[0]['id']);
            if (strlen($volunteer_role) == 0) {
                $volunteer_role = 'Outsource Kitchen';
            } else {
                $volunteer_role = ' and Outsource Kitchen';
            }
        }

        $volunteer_data = new VolunteerDetails([
            'volunteer_name' => $request['first-name'] . ' ' . $request['last-name'],
            'volunteer_role' => $volunteer_role,
            'organization_name' => $request['organization-name'],
            'organization_address' => $request['organization-address']
        ]);

        $user
            ->volunteer_details()->save($volunteer_data)
            ->profile()->save($this->get_registration_profile($request));

        $this->send_registration_email_verification($user->getAttribute('email'));
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
        $member_account->setAttribute('email_verified', true);
        $member_account->setAttribute('authenticatable', true);
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
        $caregiver_account->setAttribute('email_verified', true);
        $caregiver_account->setAttribute('authenticatable', true);
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
        $volunteer_account->setAttribute('email_verified', true);
        $volunteer_account->setAttribute('authenticatable', true);
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
        $rider_account->setAttribute('email_verified', true);
        $rider_account->setAttribute('authenticatable', true);
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
        $partner_account->setAttribute('email_verified', true);
        $partner_account->setAttribute('authenticatable', true);
        $partner_account->fill($partner_test_data)->save();
        $partner_account->roles()->attach(Role::where('role_name', 'ROLE_PARTNER')->get()[0]['id']);
        $partner_data = new PartnerDetails();
        $partner_data->fill($partner_test_data);
        $partner_account->partner_details()->save($partner_data);
    }
}

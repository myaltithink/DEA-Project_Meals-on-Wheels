<?php

namespace Tests\Feature;

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\MailController;
use App\Models\EmailVerification;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\File\UploadedFile as FileUploadedFile;
use Tests\TestCase;

use function PHPUnit\Framework\assertContains;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertStringContainsString;

class RegistrationTest extends TestCase
{
    public function test_registration_with_registered_email()
    {
        $register_as_member = $this->post('/member-registration', ['email' => 'tarucisaac@gmail.com']);
        $register_as_member->assertSessionHasErrors('email');

        $register_as_caregiver = $this->post('/caregiver-registration', ['email' => 'tarucisaac@gmail.com']);
        $register_as_caregiver->assertSessionHasErrors('email');

        $register_as_partner = $this->post('/partner-registration', ['email' => 'tarucisaac@gmail.com']);
        $register_as_partner->assertSessionHasErrors('email');

        $register_as_volunteer = $this->post('/volunteer-registration', ['email' => 'tarucisaac@gmail.com']);
        $register_as_volunteer->assertSessionHasErrors('email');
    }

    public function test_image_upload()
    {
        $test_img = new UploadedFile('tests/Feature/test_image.png', 'test_image.png', 'image/png', null);

        $uploaded_test_img = FileUploadController::upload_file($test_img, 'test_upload', 'unit-test');

        assertEquals('storage/app/uploads/unit-test/test_upload.png', $uploaded_test_img);
    }

    public function test_email_sending()
    {
        //MailController will return a \Illuminate\Mail\SentMessage if email was sent successfully
        //otherwise return null
        $test_mail = MailController::send_email('tarucisaac@gmail.com', '', 'Email Test', 'forget_pass', 123123);
        assertNotNull($test_mail);
    }

    public function test_verification_code()
    {
        //creates a forget password email verification
        $response = $this->post('/create-forgot-pass', ['email' => 'tarucisaac@gmail.com']);

        $verification_data = EmailVerification::where([
            ['email', '=', 'tarucisaac@gmail.com'],
            ['verification_type', '=', 'forget_pass']
        ]);

        assertNotNull($verification_data);
    }

    //mail sending has been comment out for this test as the following email address are not a valid ones
    public function test_user_registrations()
    {
        $register_as_member = $this->post('/member-registration', $this->getMemberTestData());
        $register_as_caregiver = $this->post('/caregiver-registration', $this->getCareGiverTestData());
        $register_as_partner = $this->post('/partner-registration', $this->getPartnerTestData());
        $register_as_volunteer = $this->post('/volunteer-registration', $this->getVolunteerTestData());
        $register_as_volunteer = $this->post('/volunteer-registration', $this->getRiderTestData());

        $registered_member = User::where('email', 'member@gmail.com')->get()[0];
        $registered_caregiver = User::where('email', 'caregiver@gmail.com')->get()[0];
        $registered_partner = User::where('email', 'partner@gmail.com')->get()[0];
        $registered_volunteer = User::where('email', 'volunteer@gmail.com')->get()[0];
        $registered_rider = User::where('email', 'rider@gmail.com')->get()[0];

        assertEquals('ROLE_MEMBER', $registered_member->roles[0]->role_name);
        assertEquals('ROLE_CAREGIVER', $registered_caregiver->roles[0]->role_name);
        assertEquals('ROLE_PARTNER', $registered_partner->roles[0]->role_name);
        assertEquals('ROLE_VOLUNTEER_COOK', $registered_volunteer->roles[1]->role_name);
        assertEquals('ROLE_VOLUNTEER_RIDER', $registered_rider->roles[1]->role_name);
    }

    public function getMemberTestData()
    {
        return array(
            //profile info
            'first-name' => 'Member',
            'last-name' => 'Name',
            'age' => '19',
            'birthday' => '2003-06-03',
            'gender' => 'male',
            'contact-num' => '123-123-123',
            'address' => '6969 street 420',
            'valid-id' => new UploadedFile('tests/Feature/test_image.png', 'test_image.png', 'image/png', null),

            //member data
            'needs' => 'some needs',
            'allergies' => 'some allergies',
            'member-eligibility' => new UploadedFile('tests/Feature/test_image.png', 'test_image.png', 'image/png', null),

            //account data
            'email' => 'member@gmail.com',
            'password' => bcrypt('wasdwasd'),
            'longtitude' => '12.2345',
            'latitude' => '8.2146',
            'status' => 'Waiting For Approval'
        );
    }

    public function getCareGiverTestData()
    {
        return array(
            //profile info
            'first-name' => 'Caregiver',
            'last-name' => 'Name',
            'age' => '19',
            'birthday' => '2003-06-03',
            'gender' => 'male',
            'contact-num' => '123-123-123',
            'address' => '6969 street 420',
            'valid-id' => new UploadedFile('tests/Feature/test_image.png', 'test_image.png', 'image/png', null),

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
    }

    public function getPartnerTestData()
    {
        return  array(
            //partner data
            'company-name' => 'HABOL Corp',
            'registered-by' => 'test_employee@gmail.com',
            'partner-address' => '234 wasddfg',
            'business-license' => new UploadedFile('tests/Feature/test_image.png', 'test_image.png', 'image/png', null),

            //account info
            'email' => 'partner@gmail.com',
            'password' => bcrypt('wasdwasd'),
            'longtitude' => '9.2345',
            'latitude' => '8.2146',
            'status' => 'Waiting For Approval'
        );
    }

    public function getVolunteerTestData()
    {
        return array(
            //profile info
            'first-name' => 'Volunteer',
            'last-name' => 'Name',
            'age' => '19',
            'birthday' => '2003-06-03',
            'gender' => 'male',
            'contact-num' => '123-123-123',
            'address' => '6969 street 420',
            'valid-id' => new UploadedFile('tests/Feature/test_image.png', 'test_image.png', 'image/png', null),

            //volunteer data
            'volunteer_name' => 'Volunteer Name',
            'volunteer-kitchen' => 'Outsource Kitchen',
            'organization_name' => 'Some Org',
            'organization_address' => '1234 org address',

            //account info
            'email' => 'volunteer@gmail.com',
            'password' => bcrypt('wasdwasd'),
            'longtitude' => '16.2345',
            'latitude' => '8.2146',
            'status' => 'Waiting For Approval'
        );
    }

    public function getRiderTestData()
    {
        return  array(
            //profile info
            'first-name' => 'Rider',
            'last-name' => 'Name',
            'age' => '19',
            'birthday' => '2003-06-03',
            'gender' => 'male',
            'contact-num' => '123-123-123',
            'address' => '6969 street 420',
            'valid-id' => new UploadedFile('tests/Feature/test_image.png', 'test_image.png', 'image/png', null),

            //volunteer data
            'volunteer_name' => 'Rider Name',
            'volunteer-rider' => 'Rider',
            'organization_name' => 'Some Org',
            'organization_address' => '1234 org address',

            //account info
            'email' => 'rider@gmail.com',
            'password' => bcrypt('wasdwasd'),
            'longtitude' => '6.2345',
            'latitude' => '8.2146',
            'status' => 'Waiting For Approval'
        );
    }
}

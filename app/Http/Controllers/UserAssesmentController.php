<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CaregiverDetails;
use App\Models\RejectedUsers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VolunteerDetails;
use App\Models\Profile;
use Illuminate\Support\Facades\Log;

class UserAssesmentController extends Controller
{

    //viewing of all pending members for approval
    public function pendingMembers()
    {
        $pending_users = User::where([['email_verified', '=', true], ['authenticatable', '=', false]])->get();
        $members = array();
        foreach ($pending_users as $member) {
            foreach ($member->roles as $role) {
                if ($role['role_name'] == 'ROLE_MEMBER') {
                    array_push($members, $member);
                }
            }
        }
        return view('MealManagement.UserEligibilityAssessment.pending-member-list')
            ->with('users', $members);
    }

    //view specific member
    public function viewPendingMember($email)
    {
        $member = User::where('email', $email)->get()[0];
        return view('MealManagement.UserEligibilityAssessment.view-member-approval')
            ->with('member', $member)
            ->with('details', $member->member_details()->get()[0])
            ->with('profile', $member->member_details()->get()[0]->profile()->get()[0])
            ->with('user_id', $member->user_id);
    }

    //approving pending member
    public function approvePendingMember(Request $email)
    {

        $member = User::find($email['user-id']);

        $member->authenticatable = true;
        $member->status = "Approved";
        $member->save();

        MailController::updateUser($member->email, "Registration Update", '', true);

        return redirect('/member-eligibility-assessment');
    }

    //rejecting pending member
    public function rejectPendingMember(Request $email)
    {

        $member = User::where('user_id', $email['user-id'])->get()[0];

        $rejected_user = new RejectedUsers;
        $rejected_user->email = $member->email;
        $rejected_user->reason_of_rejection = $email['reason'];
        $rejected_user->save();

        MailController::updateUser($member->email, "Registration Update", $rejected_user->reason_of_rejection);

        $member->delete();

        return redirect('/member-eligibility-assessment');
    }

    //viewing of all pending caregivers for approval
    public function pendingCaregivers()
    {
        $pending_users = User::where([['email_verified', '=', true], ['authenticatable', '=', false]])->get();
        $caregivers = array();
        foreach ($pending_users as $caregiver) {
            foreach ($caregiver->roles as $role) {
                if ($role['role_name'] == 'ROLE_CAREGIVER') {
                    array_push($caregivers, $caregiver);
                }
            }
        }
        return view('MealManagement.UserEligibilityAssessment.pending-caregiver-list')
            ->with('users', $caregivers);
    }

    //view specific caregiver
    public function viewPendingCaregiver($email)
    {
        $caregiver = User::where('email', $email)->get()[0];
        return view('MealManagement.UserEligibilityAssessment.view-caregiver-approval')
            ->with('caregiver', $caregiver)
            ->with('details', $caregiver->caregiver_details()->get()[0])
            ->with('profile', $caregiver->caregiver_details()->get()[0]->profile()->get()[0])
            ->with('user_id', $caregiver->user_id);
    }

    //approving pending caregiver
    public function approvePendingCaregiver(Request $email)
    {

        $caregiver = User::find($email['user-id']);

        $caregiver->authenticatable = true;
        $caregiver->status = "Approved";
        $caregiver->save();

        MailController::updateUser($caregiver->email, "Registration Update", '', true);

        return redirect('/caregiver-eligibility-assessment');
    }

    //rejecting pending caregiver
    public function rejectPendingCaregiver(Request $email)
    {

        $caregiver = User::where('user_id', $email['user-id'])->get()[0];

        $rejected_user = new RejectedUsers;
        $rejected_user->email = $caregiver->email;
        $rejected_user->reason_of_rejection = $email['reason'];
        $rejected_user->save();

        MailController::updateUser($caregiver->email, "Registration Update", $rejected_user->reason_of_rejection);

        $caregiver->delete();

        return redirect('/caregiver-eligibility-assessment');
    }

    //viewing of all pending partners for approval
    public function pendingPartners()
    {
        $pending_users = User::where([['email_verified', '=', true], ['authenticatable', '=', false]])->get();
        $partners = array();
        foreach ($pending_users as $partner) {
            foreach ($partner->roles as $role) {
                if ($role['role_name'] == 'ROLE_PARTNER') {
                    array_push($partners, $partner);
                }
            }
        }
        return view('MealManagement.UserEligibilityAssessment.pending-partner-list')
            ->with('users', $partners);
    }

    //view specific partner
    public function viewPendingPartner($email)
    {

        $partner = User::where('email', $email)->get()[0];
        return view('MealManagement.UserEligibilityAssessment.view-partner-approval')
            ->with('partner', $partner)
            ->with('details', $partner->partner_details()->get()[0])
            ->with('user_id', $partner->user_id);
    }

    //approving pending partner
    public function approvePendingPartner(Request $email)
    {

        $partner = User::find($email['user-id']);

        $partner->authenticatable = true;
        $partner->status = "Approved";
        $partner->save();

        MailController::updateUser($partner->email, "Registration Update", '', true);

        return redirect('/partner-eligibility-assessment');
    }

    //rejecting pending partner
    public function rejectPendingPartner(Request $email)
    {
        $partner = User::where('user_id', $email['user-id'])->get()[0];

        $rejected_user = new RejectedUsers;
        $rejected_user->email = $partner->email;
        $rejected_user->reason_of_rejection = $email['reason'];
        $rejected_user->save();
        MailController::updateUser($partner->email, "Registration Update", $rejected_user->reason_of_rejection);

        $partner->delete();

        return redirect('/partner-eligibility-assessment');
    }


    //viewing of all pending volunteers for approval
    public function pendingVolunteers()
    {
        $pending_users = User::where([['email_verified', '=', true], ['authenticatable', '=', false]])->get();
        $volunteers = array();
        foreach ($pending_users as $volunteer) {
            foreach ($volunteer->roles as $role) {
                if ($role['role_name'] == 'ROLE_VOLUNTEER') {
                    array_push($volunteers, $volunteer);
                }
            }
        }
        return view('MealManagement.UserEligibilityAssessment.pending-volunteer-list')
            ->with('users', $volunteers);
    }

    //view specific volunteer
    public function viewPendingVolunteer($email)
    {
        $volunteer = User::where('email', $email)->get()[0];
        return view('MealManagement.UserEligibilityAssessment.view-volunteer-approval')
            ->with('volunteer', $volunteer)
            ->with('details', $volunteer->volunteer_details()->get()[0])
            ->with('profile', $volunteer->volunteer_details()->get()[0]->profile()->get()[0])
            ->with('user_id', $volunteer->user_id);
    }

    //approving pending volunteer
    public function approvePendingVolunteer(Request $email)
    {

        $volunteer = User::find($email['user-id']);

        $volunteer->authenticatable = true;
        $volunteer->status = "Approved";
        $volunteer->save();

        MailController::updateUser($volunteer->email, "Registration Update", '', true);

        return redirect('/volunteer-eligibility-assessment');
    }

    //rejecting pending volunteer
    public function rejectPendingVolunteer(Request $email)
    {

        $volunteer = User::where('user_id', $email['user-id'])->get()[0];

        $rejected_user = new RejectedUsers;
        $rejected_user->email = $volunteer->email;
        $rejected_user->reason_of_rejection = $email['reason'];
        $rejected_user->save();

        MailController::updateUser($volunteer->email, "Registration Update", $rejected_user->reason_of_rejection);

        $volunteer->delete();

        return redirect('/volunteer-eligibility-assessment');
    }
}

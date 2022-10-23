<?php

namespace App\Http\Controllers;

use App\Models\EmailVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function send_email($recipient, $recipient_name, $subject, $verification_type, $verification_code)
    {

        Log::info('verification type ' . $verification_type);
        return Mail::send(
            'verification_email_content',
            [
                'is_registration' => $verification_type == 'registration',
                'is_forget_pass' => $verification_type == 'forget_pass',
                'verification_code' => $verification_code
            ],

            function ($message) use ($recipient, $recipient_name, $subject) {
                $message
                    ->to($recipient, $recipient_name)
                    ->subject($subject);

                $message->from(env('MAIL_USERNAME'), 'Meals on Wheels');
            }
        );
    }

    public static function create_verification_code($verification_type)
    {
        $code = random_int(100000, 999999);

        if (
            EmailVerification::where([
                ['verification_code', '=', $code],
                ['verification_type', '=', $verification_type]
            ])
            ->get()->count() != 0
        ) {
            self::create_verification_code($verification_type);
        }

        return $code;
    }

    public static function updateUser($recipient, $subject, $reason, $approve = false)
    {


        Mail::send(
            'email-user-update',
            [
                'approve' => $approve,
                'reason' => $reason
            ],

            function ($message) use ($recipient,  $subject) {
                $message
                    ->to($recipient, '')
                    ->subject($subject);

                $message->from(env('MAIL_USERNAME'), 'Meals on Wheels');
            }
        );
    }
}

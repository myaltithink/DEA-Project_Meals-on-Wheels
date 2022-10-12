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
        Mail::send(
            'email_verification',
            [
                'is_registration' => $verification_type == 'registration',
                'is_forget_pass' => $verification_type == 'forget-password',
                'verification_code' => $verification_code
            ],

            function ($message) use ($recipient, $recipient_name, $subject) {
                $message
                    ->to($recipient, $recipient_name)
                    ->subject($subject);

                $message->from('baun006cpjemail@gmail.com', 'Meals on Wheels');
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
}

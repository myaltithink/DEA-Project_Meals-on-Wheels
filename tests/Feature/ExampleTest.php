<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

use function PHPUnit\Framework\assertNotNull;

class ExampleTest extends TestCase
{
    public function test_email_sending()
    {
        //MailController will return a \Illuminate\Mail\SentMessage if email was sent successfully
        //otherwise return null
        $test_mail = MailController::send_email('tarucisaac@gmail.com', 'test', 'Email Test', 'forget_pass', 123123);
        Log::info(print_r($test_mail->toIterable(), true));
        assertNotNull($test_mail);
    }
}

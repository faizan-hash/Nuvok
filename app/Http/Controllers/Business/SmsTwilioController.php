<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;
use Exception;

class SmsTwilioController extends Controller
{
    protected $twilio;

    public function __construct()
    {
        // $sid = env('TWILIO_TEST_SID');
        // $token = env('TWILIO_TEST_TOKEN');

        // $this->twilio = new Client($sid, $token);
    }

    /**
     * Send a custom SMS to a phone number.
     */
    public function sendCustomSms($to, $message)
    {
        $account_sid = env('TWILIO_SID');
        $auth_token = env('TWILIO_TOKEN');
        $twilio_number = env('TWILIO_FROM');
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($to, ['from' => $twilio_number, 'body' => $message]);
    }

    /**
     * Send a test SMS (example).
     */
    public function sendSms()
    {
        $receiverNumber = '+923154936412';
        $message = 'Hi, testing';

        return $this->sendCustomSms($receiverNumber, $message);
    }

    /**
     * Send a welcome SMS to a client.
     */
    public function sendWelcomeSms($client)
    {
        if (!empty($client->mobile)) {
            $message = "Welcome {$client->first_name}! Thank you for registering with us.";
            return $this->sendCustomSms($client->mobile, $message);
        }

        return 'Client mobile number is missing.';
    }
}

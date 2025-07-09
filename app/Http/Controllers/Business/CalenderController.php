<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class CalenderController extends Controller
{
    public function redirectToGoogle()
    {
        try {
            $client = $this->getClient();
            return Redirect::to($client->createAuthUrl());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Google Calendar configuration error: ' . $e->getMessage() . ' Please contact your administrator to set up Google Calendar integration.');
        }
    }

    public function handleGoogleCallback(Request $request)
    {
        $client = $this->getClient();
        $client->authenticate($request->get('code'));
        Session::put('google_token', $client->getAccessToken());

        return redirect()->route('dashboard.business.calender.index')->with('success', 'Google Calendar connected!');
    }

    public function index()
    {
        try {
            $client = $this->getClient();
            
            if (Session::has('google_token')) {
                $client->setAccessToken(Session::get('google_token'));

                if ($client->isAccessTokenExpired()) {
                    Session::forget('google_token');
                    return redirect()->route('dashboard.business.calender.redirect');
                }

                $service = new Google_Service_Calendar($client);
                $calendarId = 'primary';

                $events = $service->events->listEvents($calendarId);
                return view('default.panel.business.calender.index', [
                    'events' => $events->getItems()
                ]);
            }

            return redirect()->route('dashboard.business.calender.redirect');
        } catch (\Exception $e) {
            return view('default.panel.business.calender.index', [
                'events' => [],
                'error' => $e->getMessage(),
                'setup_required' => true
            ]);
        }
    }

    private function getClient()
    {
        $client = new Google_Client();
        
        // Set Google OAuth credentials with fallback values to prevent errors
        $clientId = config('services.google.client_id', env('GOOGLE_CLIENT_ID'));
        $clientSecret = config('services.google.client_secret', env('GOOGLE_CLIENT_SECRET'));
        $redirectUri = config('services.google.redirect', env('GOOGLE_REDIRECT_URI', url('/dashboard/business/calender/callback')));
        
        if (empty($clientId)) {
            throw new \Exception('Google Client ID is not configured. Please set GOOGLE_CLIENT_ID in your .env file.');
        }
        
        if (empty($clientSecret)) {
            throw new \Exception('Google Client Secret is not configured. Please set GOOGLE_CLIENT_SECRET in your .env file.');
        }
        
        $client->setClientId($clientId);
        $client->setClientSecret($clientSecret);
        $client->setRedirectUri($redirectUri);
        $client->setScopes(Google_Service_Calendar::CALENDAR_READONLY);
        $client->setAccessType('offline');
        $client->setPrompt('consent');

        return $client;
    }

}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SetupCalendlyWebhook extends Command
{
    protected $signature = 'calendly:setup-webhook';
    protected $description = 'Setup Calendly webhook subscription';

    public function handle()
    {
        $token = config('services.calendly.api_key');
        $webhookUrl = route('dashboard.business.calendly.webhook');
        $organizationUri = config('services.calendly.organization_uri');
        $userUri = config('services.calendly.user_uri');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer {$token}"
        ])->post('https://api.calendly.com/webhook_subscriptions', [
            'url' => $webhookUrl,
            'events' => ['invitee.created', 'invitee.canceled'],
            'organization' => $organizationUri,
            'user' => $userUri,
            'scope' => 'user'
        ]);

        if ($response->successful()) {
            $this->info('Webhook created successfully!');
            $this->line(json_encode($response->json(), JSON_PRETTY_PRINT));
        } else {
            $this->error('Failed to create webhook: ' . $response->body());
        }
    }
}
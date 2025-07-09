<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\BusinessBookingCalendly;

class BusinessBookingCalendlyWebhookController extends Controller
{
    protected $eventTypeFilter;

    public function __construct()
    {
        // Set your specific event type URI in config/services.php
        $this->eventTypeFilter = config('services.calendly.event_type_uri');
    }

    public function handleWebhook(Request $request)
    {
        Log::info('Raw Request', ['body' => $request->all()]);

        $event = $request->input('event');
        $payload = $request->input('payload'); // <-- updated to match Calendly's structure

        Log::info('Calendly Webhook Received', ['event' => $event, 'payload' => $payload]);

        // Ensure scheduled_event exists
        if (!isset($payload['scheduled_event'])) {
            Log::error('Missing scheduled_event in payload');
            return response()->json(['error' => 'Invalid payload'], 400);
        }

        $eventTypeUri = $payload['scheduled_event']['event_type'] ?? null;

        if ($this->eventTypeFilter && $eventTypeUri !== $this->eventTypeFilter) {
            Log::debug('Skipping webhook event - event type does not match filter');
            return response()->json(['status' => 'skipped']);
        }

        switch ($event) {
            case 'invitee.created':
                return $this->handleInviteeCreated($payload);
            case 'invitee.canceled':
                return $this->handleInviteeCanceled($payload);
            default:
                Log::warning('Unhandled Calendly webhook event', ['event' => $event]);
                return response()->json(['status' => 'ignored'], 200);
        }
    }

    protected function handleInviteeCreated(array $payload)
    {
        Log::info('Handling invitee.created event', ['payload' => $payload]);

        $event = $payload['scheduled_event'];
        $inviteeDetails = [
            'questions_and_answers' => $this->extractQuestionsAndAnswers($payload['questions_and_answers'] ?? []),
            'timezone' => $payload['timezone'] ?? null,
            'text_reminder_number' => $payload['text_reminder_number'] ?? null,
            'rescheduled' => $payload['rescheduled'] ?? false,
            'old_invitee' => $payload['old_invitee'] ?? null,
            'new_invitee' => $payload['new_invitee'] ?? null,
        ];

        try {
            BusinessBookingCalendly::updateOrCreate(
                ['calendly_event_id' => $payload['uri']],
                [
                    'event_type' => $event['name'] ?? 'Unknown',
                    'invitee_name' => $payload['name'] ?? null,
                    'invitee_email' => $payload['email'] ?? null,
                    'invitee_details' => $inviteeDetails,
                    'start_time' => $event['start_time'] ?? null,
                    'end_time' => $event['end_time'] ?? null,
                    'status' => strtolower($payload['status'] ?? 'unknown'),
                    'cancel_url' => $payload['cancel_url'] ?? null,
                    'reschedule_url' => $payload['reschedule_url'] ?? null,
                    'location' => $event['location']['join_url'] ?? $event['location']['location'] ?? null,
                ]
            );
        } catch (\Exception $e) {
            Log::error('Error saving Calendly booking', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json(['error' => 'Internal Server Error'], 500);
        }

        return response()->json(['status' => 'saved']);
    }

    protected function handleInviteeCanceled(array $payload)
    {
        try {
            BusinessBookingCalendly::where('calendly_event_id', $payload['uri'])->update([
                'status' => 'canceled',
                'cancel_reason' => $payload['cancel_reason'] ?? null,
                'canceled_at' => $payload['canceled_at'] ?? now(),
                'canceler_name' => $payload['canceler_name'] ?? null,
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating cancellation', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json(['error' => 'Internal Server Error'], 500);
        }

        return response()->json(['status' => 'canceled']);
    }

    protected function extractQuestionsAndAnswers($questionsAndAnswers)
    {
        $result = [];

        foreach ($questionsAndAnswers ?? [] as $qa) {
            $result[] = [
                'question' => $qa['question'] ?? null,
                'answer' => $qa['answer'] ?? null,
                'position' => $qa['position'] ?? null,
                'question_type' => $qa['type'] ?? null,
            ];
        }

        return $result;
    }
}

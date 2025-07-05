<?php  
namespace App\Http\Controllers\Business;
use App\Helpers\Classes\ApiHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiEstimatorController extends Controller
{
    public function index()
    {
        return view('default.panel.business.AiEstimator.index');
    }

// public function estimate(Request $request)
// {
//     $request->validate([
//         'task_information' => 'required|string',
//         'labour_amount'    => 'required|integer|min:1',
//         'time_required'    => 'required|numeric|min:0.5',
//     ]);

//     $prompt = "Estimate the total price (in USD) to complete the task described below.\n\n"
//             . "Task Description: {$request->task_information}\n"
//             . "Labour Required: {$request->labour_amount} people\n"
//             . "Time Required: {$request->time_required} hours\n\n"
//             . "Only respond with the estimated cost as a number. Do not include currency symbols, extra text, or line breaks.";

//     try {
//         $response = Http::withToken(env('OPENAI_API_KEY'))->post('https://api.openai.com/v1/chat/completions', [
//             // 'model' => 'gpt-4',
//             // 'model' => 'gpt-4.1',
//             'model' => 'gpt-3.5-turbo',
//             'messages' => [
//                 ['role' => 'system', 'content' => 'You are a professional estimator.'],
//                 ['role' => 'user', 'content' => $prompt],
//             ],
//             'temperature' => 0.3,
//         ]);

//         // 🟨 Log full raw response from OpenAI to see what's returned
//         Log::info('Full OpenAI API Response:', $response->json());

//         $aiEstimatedPriceRaw = $response->json()['choices'][0]['message']['content'] ?? '0';

//         // 🟨 Log extracted raw content for confirmation
//         Log::info('AI Extracted Message Content:', ['content' => $aiEstimatedPriceRaw]);

//         preg_match('/\d+(\.\d+)?/', $aiEstimatedPriceRaw, $matches);
//         $aiEstimatedPrice = isset($matches[0]) ? floatval($matches[0]) : 0;

//         return response()->json([
//             'success' => true,
//             // 'estimated_price' => '$99',
//             'estimated_price' => $aiEstimatedPrice,
//         ]);
//     } catch (\Exception $e) {
//         Log::error('AI Estimation Failed', [
//             'error' => $e->getMessage(),
//             'input' => $request->all(),
//         ]);

//         return response()->json([
//             'success' => false,
//             'message' => 'Error while estimating task price.',
//         ], 500);
//     }
// }


public function estimate(Request $request)
{
    $request->validate([
        'task_information' => 'required|string',
        'number_of_people'    => 'required|integer|min:1',
        'time_required'    => 'required|numeric|min:0.5',
    ]);

    $prompt = "Estimate the total price (in USD) to complete the task described below.\n\n"
        . "Task Description: {$request->task_information}\n"
        . "Labour Required: {$request->number_of_people} people\n"
        . "Time Required: {$request->time_required} hours\n\n"
        . "Only respond with the estimated cost as a number. Do not include currency symbols, extra text, or line breaks.";

    try {
        // 🔑 Get dynamic API key using your helper
        $apiKey = ApiHelper::setOpenAiKey();

        if (!$apiKey) {
            throw new \Exception("OpenAI API key not set.");
        }

        $response = Http::withToken($apiKey)->post('https://api.openai.com/v1/chat/completions', [
            // 'model' => 'gpt-3.5-turbo',
            'model' => 'gpt-4',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a professional estimator.'],
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => 0.3,
        ]);

        $responseData = $response->json();

        Log::info('Full OpenAI API Response:', $responseData);

        $aiEstimatedPriceRaw = $responseData['choices'][0]['message']['content'] ?? '0';
        Log::info('AI Extracted Message Content:', ['content' => $aiEstimatedPriceRaw]);

        preg_match('/\d+(\.\d+)?/', $aiEstimatedPriceRaw, $matches);
        $aiEstimatedPrice = isset($matches[0]) ? floatval($matches[0]) : 0;

        return response()->json([
            'success' => true,
            'estimated_price' => $aiEstimatedPrice,
        ]);
    } catch (\Exception $e) {
        Log::error('AI Estimation Failed', [
            'error' => $e->getMessage(),
            'input' => $request->all(),
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Error while estimating task price.',
        ], 500);
    }
}


    
}
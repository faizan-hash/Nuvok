<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('panel.authentication.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        Log::info('Registration process started.');

        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'surname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            Log::info('Validation successful for email: ' . $request->email);

            $user = User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            Log::info('User created successfully for email: ' . $request->email);

            event(new Registered($user));

            Auth::login($user);

            Log::info('User logged in and redirecting to dashboard. Email: ' . $request->email);
            return redirect(RouteServiceProvider::HOME);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed for registration.', [
                'errors' => $e->errors(),
                'input' => $request->all()
            ]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('An unexpected error occurred during registration.', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            // Re-throw the exception to show the error page
            throw $e;
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller {
    public function register(Request $request): \Illuminate\Http\JsonResponse {
        try {
            $userdata = $request->validate([
                'name' => 'required|max:30',
                'email' => 'required|string|unique:users|max:50',
                'password' => 'required|string|max:16',
            ]);

            $userdata['password'] = bcrypt($userdata['password']);  # Hash password
            $user = User::create($userdata);
            auth()->login($user);

            return response()->json(['status' => true, 'message' => 'Registered successfully!']);
        } catch(\Exception $e) {
            # error_log($e);
            return response()->json(['status' => false, 'message' => 'Error while register user: ' . $e], 422);
        }
    }

    public function login(Request $request): \Illuminate\Http\JsonResponse {
        // Limit 5 attempts to sign-in with cool down in 30 minutes
        if (RateLimiter::tooManyAttempts('login:' . $request->ip(), 5)) {
            return response()->json(['status' => false, 'message' => 'Too many login attempts. Please try again later'], 429);
        }

        // Then log the attempt if it’s not too many
        RateLimiter::hit('login:' . $request->ip(), 1800);

        try {
            $validated_data = $request->validate([
                'email' => 'required|string',
                'password' => 'required|string'
            ]);

            $credentials = ['email' => $validated_data['email'], 'password' => $validated_data['password']];
            if (auth()->attempt($credentials)) {
                $request->session()->regenerate();

                return response()->json([ 'status' => true, 'message' => 'Signed successfully!' ]);
            }

            return response()->json(['status' => false, 'message' => 'Login failed: incorrect userdata']); # If authentication failed
        } catch(\Exception $e) {
            # error_log($e);
            return response()->json(['status' => false, 'message' => 'Error while register user: ' . $e], 422);
        }
    }

    public function logout(Request $request): \Illuminate\Http\JsonResponse {
        try {
            Auth::logout();
            $request->session()->invalidate(); // Invalidate the session
            $request->session()->regenerateToken(); // Regenerate the session token
            return response()->json(['status' => true, 'message' => 'Log out successfully!']);
        } catch(\Exception $e) {
            error_log($e);
            return response()->json(['status' => false, 'message' => 'Error while log out!']);
        }      
    }

    public function auto_login(Request $req) {
        if (Auth::check()) {
            return response()->json(['status' => true, 'message' => 'Auto login was succesfull!']);
        } else {
            return response()->json(['status' => false, 'message' => 'Auto login failed!']);
        }
    }
}

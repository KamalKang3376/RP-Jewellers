<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('register');
    }


    public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
    ]);

    $otp = random_int(100000, 999999);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'otp_hash' => Hash::make($otp),
        'otp_expires_at' => now()->addMinutes(10),
    ]);

    Mail::to($user->email)->send(new OtpMail($otp));

    session(['otp_user_id' => $user->id]);

    return redirect()
        ->route('otp.verify')
        ->with('success', 'OTP has been sent to your email.');
}

public function showOtpForm()
{
    return view('verify-otp');
}

public function verifyOtp(Request $request)
{
    $request->validate([
        'otp' => 'required|digits:6',
    ]);

    $userId = session('otp_user_id');

    if (!$userId) {
        return redirect()
            ->route('register')
            ->with('error', 'OTP session expired. Please register again.');
    }

    $user = User::find($userId);

    if (!$user) {
        return redirect()
            ->route('register')
            ->with('error', 'User not found.');
    }

    if (!$user->otp_expires_at || $user->otp_expires_at->isPast()) {
        return back()->with('error', 'OTP has expired. Please request a new OTP.');
    }

    if (!Hash::check($request->otp, $user->otp_hash)) {
        return back()->with('error', 'Invalid OTP. Please try again.');
    }

    $user->update([
        'otp_hash' => null,
        'otp_expires_at' => null,
    ]);

    session()->forget('otp_user_id');

    Auth::login($user);

    $request->session()->regenerate();

    return redirect('/')
        ->with('success', 'Email verified successfully. Welcome!');
}

public function resendOtp()
{
    $userId = session('otp_user_id');

    if (!$userId) {
        return redirect()
            ->route('register')
            ->with('error', 'OTP session expired. Please register again.');
    }

    $user = User::find($userId);

    if (!$user) {
        return redirect()
            ->route('register')
            ->with('error', 'User not found.');
    }

    $otp = random_int(100000, 999999);

    $user->update([
        'otp_hash' => Hash::make($otp),
        'otp_expires_at' => now()->addMinutes(10),
    ]);

    Mail::to($user->email)->send(new OtpMail($otp));

    return back()->with('success', 'A new OTP has been sent to your email.');
}

    public function showLogin()
    {
        return view('login');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()
            ->withInput($request->only('email'))
            ->with('error', 'Invalid email or password.');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'You have been logged out.');
    }
}
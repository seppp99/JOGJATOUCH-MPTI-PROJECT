<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class AuthController
{
    /**
     * Show registration/signup page
     */
    public function registerPage()
    {
        // If user is already logged in, redirect to account dashboard
        if (session()->has('user')) {
            return redirect()->route('akun');
        }
        return view('pages.daftar');
    }



    /**
     * Show login page
     */
    public function loginPage()
    {
        if (\Illuminate\Support\Facades\Auth::check()) {
            return redirect()->route('akun');
        }
        return view('pages.login');
    }

    /**
     * Handle login submission
     */
    public function loginSubmit(\App\Http\Requests\LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (\Illuminate\Support\Facades\Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('akun'));
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        \Illuminate\Support\Facades\Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    /**
     * Handle OTP request for new registration flow
     */
    public function sendOtpRegister(\App\Http\Requests\RegisterRequest $request)
    {
        $data = $request->validated();

        // Rate Limiting: 3x per jam untuk email yang sama
        $key = 'register-otp:' . $data['email'];
        if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts($key, 3)) {
            return back()->with('error', 'Terlalu banyak percobaan. Silakan coba lagi setelah 1 jam.')->withInput();
        }
        \Illuminate\Support\Facades\RateLimiter::hit($key, 3600); // jendela 1 jam

        try {
            // Generate OTP 6 digit
            $otp = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

            // Simpan OTP ke cache (TTL 5 menit)
            \Illuminate\Support\Facades\Cache::put('otp_register:' . $data['email'], $otp, now()->addMinutes(5));

            // Simpan data registrasi ke cache (TTL 10 menit)
            $regData = [
                'name' => $data['name'],
                'whatsapp_number' => $data['whatsapp_number'],
                'email' => $data['email'],
                'password' => \Illuminate\Support\Facades\Hash::make($data['password']),
            ];
            \Illuminate\Support\Facades\Cache::put('reg_data:' . $data['email'], $regData, now()->addMinutes(10));

            // Simpan email ke session untuk referensi halaman verifikasi
            session(['register_email' => $data['email']]);

            // Dispatch job kirim email
            \App\Jobs\SendOtpEmailJob::dispatch($data['email'], $otp, 'register');

            return redirect()->route('register.verifikasi')->with('success', 'Kode OTP telah dikirim ke email Anda.');

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Register OTP Error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat mengirim OTP.')->withInput();
        }
    }

    /**
     * Show verification page
     */
    public function verifyPage()
    {
        $email = session('register_email');

        if (!$email) {
            return redirect()->route('daftar')->with('error', 'Sesi pendaftaran tidak valid atau kedaluwarsa.');
        }

        return view('pages.verifikasi-otp', compact('email'));
    }

    /**
     * Verify OTP and complete registration
     */
    public function verifyOtpRegister(\App\Http\Requests\VerifyOtpRequest $request)
    {
        $email = session('register_email');
        if (!$email) {
            return redirect()->route('daftar')->with('error', 'Sesi pendaftaran berakhir. Silakan daftar ulang.');
        }

        $attemptKey = 'otp_attempts:' . $email;
        if (\Illuminate\Support\Facades\Cache::get($attemptKey, 0) >= 5) {
            \Illuminate\Support\Facades\Cache::forget('otp_register:' . $email);
            \Illuminate\Support\Facades\Cache::forget('reg_data:' . $email);
            \Illuminate\Support\Facades\Cache::forget($attemptKey);
            session()->forget('register_email');
            return redirect()->route('daftar')->with('error', 'Terlalu banyak percobaan salah. Silakan daftar ulang.');
        }

        $cachedOtp = \Illuminate\Support\Facades\Cache::get('otp_register:' . $email);
        if (!$cachedOtp) {
            return back()->withErrors(['otp' => 'Kode kadaluarsa. Silakan daftar ulang untuk mendapat kode baru.']);
        }

        if ($cachedOtp !== $request->otp) {
            \Illuminate\Support\Facades\Cache::put($attemptKey, \Illuminate\Support\Facades\Cache::get($attemptKey, 0) + 1, now()->addMinutes(30));
            return back()->withErrors(['otp' => 'Kode OTP salah. Silakan coba lagi.']);
        }

        // OTP Valid!
        \Illuminate\Support\Facades\Cache::pull('otp_register:' . $email);
        $regData = \Illuminate\Support\Facades\Cache::pull('reg_data:' . $email);

        if (!$regData) {
            return redirect()->route('daftar')->with('error', 'Data pendaftaran kadaluarsa. Silakan daftar ulang.');
        }

        try {
            $user = \App\Models\User::create([
                'name' => $regData['name'],
                'whatsapp_number' => $regData['whatsapp_number'],
                'email' => $regData['email'],
                'password' => $regData['password'],
                'email_verified_at' => now(),
            ]);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Gagal membuat akun', ['email' => $email, 'error' => $e->getMessage()]);
            return back()->withErrors(['otp' => 'Terjadi kesalahan saat membuat akun. Silakan coba lagi.']);
        }

        \Illuminate\Support\Facades\Auth::login($user);

        session()->forget('register_email');
        \Illuminate\Support\Facades\Cache::forget($attemptKey);

        return redirect()->route('akun')->with('success', 'Pendaftaran berhasil! Selamat datang di JogjaTouch.');
    }
}


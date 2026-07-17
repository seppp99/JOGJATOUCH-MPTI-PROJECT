<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Support\Facades\RateLimiter;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Jobs\SendOtpEmailJob;

use App\Http\Requests\VerifyResetOtpRequest;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function showForm()
    {
        return view('pages.lupa-password.email');
    }

    public function sendOtp(ForgotPasswordRequest $request)
    {
        $email = $request->validated()['email'];
        $key = 'forgot-otp:' . $email;

        if (RateLimiter::tooManyAttempts($key, 3)) {
            return back()->with('status', 'Jika email terdaftar, kode OTP telah dikirim.')->withInput();
        }
        RateLimiter::hit($key, 3600);

        $user = User::where('email', $email)->first();

        if ($user) {
            $otp = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            Cache::put('otp_reset:' . $email, $otp, now()->addMinutes(5));
            session(['reset_pending_email' => $email]);

            try {
                SendOtpEmailJob::dispatch($email, $otp, 'reset');
            } catch (\Throwable $e) {
                Log::error('Gagal kirim OTP reset', ['error' => $e->getMessage()]);
            }
        }

        return redirect()->route('lupa-password.verifikasi')
            ->with('status', 'Jika email terdaftar, kode OTP telah dikirim ke email tersebut.');
    }

    public function verifyPage()
    {
        $email = session('reset_pending_email');
        if (!$email) {
            return redirect()->route('lupa-password')
                ->with('status', 'Sesi reset berakhir. Silakan mulai ulang.');
        }

        return view('pages.lupa-password.verifikasi', ['email' => $email]);
    }

    public function verifyOtp(VerifyResetOtpRequest $request)
    {
        $email = session('reset_pending_email');
        if (!$email) {
            return redirect()->route('lupa-password')
                ->with('status', 'Sesi reset berakhir. Silakan mulai ulang.');
        }

        $attemptKey = 'reset_otp_attempts:' . $email;
        if (Cache::get($attemptKey, 0) >= 5) {
            Cache::forget('otp_reset:' . $email);
            Cache::forget($attemptKey);
            session()->forget('reset_pending_email');
            return redirect()->route('lupa-password')
                ->with('status', 'Terlalu banyak percobaan salah. Silakan mulai ulang.');
        }

        $cachedOtp = Cache::get('otp_reset:' . $email);
        if (!$cachedOtp) {
            return back()->withErrors(['otp' => 'Kode kadaluarsa. Silakan minta kode baru.']);
        }

        if ($cachedOtp !== $request->otp) {
            Cache::put($attemptKey, Cache::get($attemptKey, 0) + 1, now()->addMinutes(30));
            return back()->withErrors(['otp' => 'Kode OTP salah. Silakan coba lagi.']);
        }

        // OTP is correct
        Cache::pull('otp_reset:' . $email);
        Cache::forget($attemptKey);

        session()->forget('reset_pending_email');
        session(['reset_email' => $email]);

        return redirect()->route('lupa-password.baru');
    }

    public function newPassPage()
    {
        if (!session('reset_email')) {
            return redirect()->route('lupa-password')
                ->with('status', 'Sesi reset berakhir. Silakan mulai ulang.');
        }

        return view('pages.lupa-password.baru');
    }

    public function reset(ResetPasswordRequest $request)
    {
        $email = session('reset_email');
        if (!$email) {
            return redirect()->route('lupa-password')->with('status', 'Sesi reset berakhir. Silakan mulai ulang.');
        }

        $user = User::where('email', $email)->first();
        if (!$user) {
            session()->forget('reset_email');
            return redirect()->route('lupa-password')->with('status', 'Akun tidak ditemukan. Silakan mulai ulang.');
        }

        try {
            $user->password = $request->validated()['password'];
            $user->setRememberToken(Str::random(60));
            $user->save();
        } catch (\Throwable $e) {
            Log::error('Gagal reset password', ['email' => $email, 'error' => $e->getMessage()]);
            return back()->withErrors(['password' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }

        session()->forget('reset_email');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Password berhasil diperbarui. Silakan masuk dengan password baru Anda.');
    }
}

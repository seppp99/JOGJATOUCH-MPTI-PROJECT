<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Support\Facades\RateLimiter;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Jobs\SendOtpEmailJob;

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
        // Placeholder for phase 2
        return "Ini halaman input OTP reset password. Tahap 2 belum dikerjakan.";
    }
}

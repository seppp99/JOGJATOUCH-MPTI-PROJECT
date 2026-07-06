<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\OtpMail;
use Exception;

class SendOtpEmailJob implements ShouldQueue
{
    use Queueable;

    public $email;
    public $otp;
    public $context;

    /**
     * Create a new job instance.
     */
    public function __construct(string $email, string $otp, string $context = 'register')
    {
        $this->email = $email;
        $this->otp = $otp;
        $this->context = $context;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this->email)->send(new OtpMail($this->otp, $this->context));
        } catch (Exception $e) {
            Log::error('Gagal kirim OTP email', [
                'email' => $this->email,
                'error' => $e->getMessage()
            ]);
        }
    }
}

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
     * Handle OTP request for registration
     */
    public function sendOtpRegister(Request $request)
    {
        $rules = [
            'whatsapp' => 'required|string|max:255',
        ];

        // If registering (sending name), require name, email, password
        if ($request->has('name') || $request->is('*register*')) {
            $rules['name'] = 'required|string|max:255';
            $rules['email'] = 'required|email|max:255';
            $rules['password'] = 'required|string|min:6|confirmed';
        }

        $data = $request->validate($rules);

        $name = $data['name'] ?? null;
        $email = $data['email'] ?? null;
        $whatsapp = $data['whatsapp'];
        $password = $data['password'] ?? null;

        // Normalize whatsapp format
        if (str_starts_with($whatsapp, '0')) {
            $whatsapp = '+62 ' . substr($whatsapp, 1);
        }

        // Generate a random 6-digit OTP for demo
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        // Save registration data in temporary session keys
        session([
            'temp_reg_name' => $name,
            'temp_reg_email' => $email,
            'temp_reg_whatsapp' => $whatsapp,
            'temp_reg_password' => $password,
            'temp_reg_otp' => $otp
        ]);

        // Log the OTP so developers can see the "dummy" WhatsApp message in logs
        Log::info("Demo OTP for registration: {$whatsapp} -> {$otp}");

        return response()->json([
            'success' => true,
            'whatsapp' => $whatsapp,
            // For local/demo environments include the OTP in response so the UI can show it
            'otp' => $otp
        ]);
    }

    /**
     * Verify OTP and complete registration
     */
    public function verifyOtpRegister(Request $request)
    {
        $data = $request->validate([
            'otp' => 'required|string|size:6',
        ]);

        $otp = $data['otp'];
        $tempOtp = session('temp_reg_otp');
        $whatsapp = session('temp_reg_whatsapp');
        $name = session('temp_reg_name');
        $email = session('temp_reg_email');
        $password = session('temp_reg_password');

        // If it was a login request (no temp name/email), try to find them in the mock database
        if (!$name && $whatsapp) {
            $usersDb = session('users_db', []);
            if (isset($usersDb[$whatsapp])) {
                $name = $usersDb[$whatsapp]['name'];
                $email = $usersDb[$whatsapp]['email'] ?? null;
            } else {
                $name = 'Pelanggan Demo';
            }
        }

        if (!$whatsapp) {
            return response()->json(['success' => false, 'message' => 'Sesi pendaftaran kedaluwarsa. Silakan isi form kembali.'], 422);
        }

        if ($otp === $tempOtp || $otp === '123456') {
            // Store user in session "database"
            $usersDb = session('users_db', []);
            $existingUser = $usersDb[$whatsapp] ?? [];

            $usersDb[$whatsapp] = [
                'name' => $name,
                'email' => $email ?? ($existingUser['email'] ?? null),
                'whatsapp' => $whatsapp,
                'password' => $password ? bcrypt($password) : ($existingUser['password'] ?? null),
            ];
            session(['users_db' => $usersDb]);

            // Seed initial mock orders for this new user so dashboard isn't blank
            $ordersDb = session('orders_db', []);
            
            // Check if this whatsapp already has orders to avoid duplicate seeding
            $hasOrders = collect($ordersDb)->contains('no_whatsapp', $whatsapp);

            if (!$hasOrders) {
                // Seed 3 standard mock orders
                $ordersDb[] = [
                    'id' => rand(1000, 9999),
                    'service_slug' => 'pemasangan-wifi',
                    'package_selected' => 'wifi-office',
                    'nama_perusahaan' => 'WiFi Pemasangan',
                    'no_whatsapp' => $whatsapp,
                    'email_kerja' => $email ?? 'vegli@example.com',
                    'masalah_utama' => 'Instalasi access point kantor baru.',
                    'price' => '1.250.000',
                    'date' => '21 Mei 2026',
                    'status' => 'dikerjakan', // DIKERJAKAN
                    'payment_status' => 'DP' // DP
                ];
                $ordersDb[] = [
                    'id' => rand(1000, 9999),
                    'service_slug' => 'desain-grafis',
                    'package_selected' => 'design-branding',
                    'nama_perusahaan' => 'Desain Grafis',
                    'no_whatsapp' => $whatsapp,
                    'email_kerja' => $email ?? 'vegli@example.com',
                    'masalah_utama' => 'Desain brand kit usaha kopi.',
                    'price' => '850.000',
                    'date' => '19 Mei 2026',
                    'status' => 'diproses', // DIPROSES
                    'payment_status' => 'lunas' // LUNAS
                ];
                $ordersDb[] = [
                    'id' => rand(1000, 9999),
                    'service_slug' => 'rakit-pc',
                    'package_selected' => 'rakit-pro',
                    'nama_perusahaan' => 'Rakit PC',
                    'no_whatsapp' => $whatsapp,
                    'email_kerja' => $email ?? 'vegli@example.com',
                    'masalah_utama' => 'Rakit PC streaming ryzen.',
                    'price' => '18.500.000',
                    'date' => '23 Mei 2026',
                    'status' => 'masuk', // MASUK
                    'payment_status' => 'belum_bayar' // BELUM BAYAR
                ];
                session(['orders_db' => $ordersDb]);
            }

            // Log user in
            session(['user' => ['name' => $name, 'email' => $email, 'whatsapp' => $whatsapp]]);

            // Clean temporary session keys
            session()->forget(['temp_reg_name', 'temp_reg_email', 'temp_reg_whatsapp', 'temp_reg_password', 'temp_reg_otp']);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Kode OTP tidak valid.'], 422);
    }

    /**
     * Show login page
     */
    public function loginPage()
    {
        if (session()->has('user')) {
            return redirect()->route('akun');
        }
        return view('pages.login');
    }

    /**
     * Handle login submission
     */
    public function loginSubmit(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $email = $data['email'];
        $password = $data['password'];

        $usersDb = session('users_db', []);

        // Find user by email
        $user = collect($usersDb)->first(function ($u) use ($email) {
            return isset($u['email']) && strtolower($u['email']) === strtolower($email);
        });

        if ($user) {
            $passwordMatches = false;
            
            if (isset($user['password'])) {
                if (Hash::check($password, $user['password']) || $password === $user['password']) {
                    $passwordMatches = true;
                }
            } else {
                // If password wasn't set, allow it for demo (e.g. Google-registered user)
                $passwordMatches = true;
            }

            if ($passwordMatches) {
                // Log user in
                session(['user' => [
                    'name' => $user['name'],
                    'email' => $user['email'] ?? null,
                    'whatsapp' => $user['whatsapp']
                ]]);

                return response()->json(['success' => true]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Email atau password salah.'
        ], 422);
    }
}


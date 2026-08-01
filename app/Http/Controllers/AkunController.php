<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AkunController
{
    private function getCounts(): array
    {
        $user = Auth::user();
        $activeCount = $user->orders()->whereIn('status', ['pending', 'deal'])->count();
        $historyCount = $user->orders()->whereIn('status', ['completed', 'canceled'])->count();

        return [$activeCount, $historyCount];
    }

    public function index()
    {
        $orders = Auth::user()
            ->orders()
            ->whereIn('status', ['pending', 'deal'])
            ->latest()
            ->get();

        [$activeCount, $historyCount] = $this->getCounts();

        return view('pages.akun', compact('orders', 'activeCount', 'historyCount'));
    }

    public function riwayat()
    {
        $orders = Auth::user()
            ->orders()
            ->whereIn('status', ['completed', 'canceled'])
            ->latest()
            ->get();

        [$activeCount, $historyCount] = $this->getCounts();

        return view('pages.akun-riwayat', compact('orders', 'activeCount', 'historyCount'));
    }

    public function detail(string $orderCode)
    {
        $order = Order::where('order_code', $orderCode)->firstOrFail();

        // PROTEKSI IDOR (Insecure Direct Object Reference)
        // Memastikan pesanan yang dibuka benar-benar milik user yang sedang login
        // Jika tidak cocok, tolak akses dengan status 403 Forbidden
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak: Anda tidak berhak melihat pesanan ini.');
        }

        [$activeCount, $historyCount] = $this->getCounts();

        return view('pages.akun-pesanan-detail', compact('order', 'activeCount', 'historyCount'));
    }
}

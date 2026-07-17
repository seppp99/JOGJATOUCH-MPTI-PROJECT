<x-layouts.app>
    <x-slot:title>
        Riwayat Pesanan — JogjaTouch
    </x-slot:title>

    @php
        // Sumber data sama dengan dashboard /akun: session orders_db difilter
        // per user, lalu dipisah aktif vs riwayat (selesai/dibatalkan). Angka di
        // sidebar & isi panel diturunkan dari sini agar konsisten. Siap disambung
        // ke query database sungguhan tanpa mengubah struktur view ini.
        $user = Illuminate\Support\Facades\Auth::user();
        $historyStatuses = ['selesai', 'dibatalkan'];

        $userOrders = array_values(array_filter(
            session('orders_db', []),
            fn ($order) => isset($order['no_whatsapp']) && $order['no_whatsapp'] === $user->whatsapp_number
        ));

        $activeOrders = array_values(array_filter(
            $userOrders,
            fn ($order) => !in_array(strtolower($order['status'] ?? 'masuk'), $historyStatuses)
        ));

        $historyOrders = array_values(array_filter(
            $userOrders,
            fn ($order) => in_array(strtolower($order['status'] ?? ''), $historyStatuses)
        ));
    @endphp

    <main class="min-h-screen bg-[#FBF9F6] py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-6">

            <!-- Dashboard Grid Layout -->
            <div class="flex flex-col md:flex-row gap-8 lg:gap-12 items-start">

                <!-- Left Sidebar Component -->
                <x-dashboard-sidebar :active-count="count($activeOrders)" :history-count="count($historyOrders)" />

                <!-- Right Content / History Component -->
                <x-dashboard-history :orders="$historyOrders" />

            </div>

        </div>
    </main>
</x-layouts.app>

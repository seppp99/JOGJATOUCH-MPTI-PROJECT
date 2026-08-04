<x-layouts.app>
    <x-slot:title>
        Riwayat Pesanan — JogjaTouch
    </x-slot:title>

    <main class="min-h-screen bg-[#FBF9F6] py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-6">

            <!-- Dashboard Grid Layout -->
            <div class="flex flex-col md:flex-row gap-8 lg:gap-12 items-start">

                <!-- Left Sidebar Component -->
                <x-dashboard-sidebar :active-count="$activeCount" :history-count="$historyCount" />

                <!-- Right Content / History Component -->
                <x-dashboard-history :orders="$orders" />

            </div>

        </div>
    </main>
</x-layouts.app>

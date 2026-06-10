<x-layouts.app>
    <x-slot:title>
        Dashboard Pelanggan — JogjaTouch
    </x-slot:title>

    <main class="min-h-screen bg-[#FBF9F6] py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-6">
            
            <!-- Dashboard Grid Layout -->
            <div class="flex flex-col md:flex-row gap-8 lg:gap-12 items-start">
                
                <!-- Left Sidebar Component -->
                <x-dashboard-sidebar />

                <!-- Right Content / Active Orders Component -->
                <x-dashboard-orders />

            </div>

        </div>
    </main>
</x-layouts.app>

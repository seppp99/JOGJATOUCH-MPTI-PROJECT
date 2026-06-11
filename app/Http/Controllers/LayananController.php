<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class LayananController extends Controller
{
    /**
     * Get details of services and packages
     */
    private function getServices()
    {
        return [
            'pemasangan-wifi' => [
                'slug' => 'pemasangan-wifi',
                'category_label' => 'LAYANAN 01 . WIFI',
                'title_prefix' => 'Pemasangan',
                'title_italic' => 'WiFi.',
                'description' => 'Instalasi access point, penarikan kabel, setting router, coverage test menyeluruh di lokasi. Cocok untuk rumah & kantor.',
                'form_title' => 'Data Pemasangan WiFi',
                'form_subtitle' => 'Jadwalkan survey lokasi gratis sekarang.',
                'submit_button_text' => 'Minta Pemasangan WiFi',
                'options' => [
                    [
                        'id' => 'wifi-standard',
                        'name' => 'Instalasi Rumah Standard',
                        'price' => '350.000',
                        'description' => 'Instalasi access point, penarikan kabel ethernet, setting modem/router bawaan provider.',
                        'features' => [
                            '1 unit Access Point (bawaan / request)',
                            'Set up SSID & sandi wifi',
                            'Kabel LAN up to 10m',
                            'Testing coverage standard'
                        ]
                    ],
                    [
                        'id' => 'wifi-office',
                        'name' => 'Instalasi Kantor / Cafe',
                        'price' => '750.000',
                        'is_popular' => true,
                        'description' => 'Penarikan kabel rapi, konfigurasi multi-AP, manajemen bandwidth agar internet tidak lelet saat ramai.',
                        'features' => [
                            'Up to 3 unit Access Point',
                            'Bandwidth management / QoS',
                            'Kabel LAN premium up to 25m',
                            'Coverage map & site survey'
                        ]
                    ],
                    [
                        'id' => 'wifi-voucher',
                        'name' => 'Sistem Voucher Hotspot',
                        'price' => '1.500.000',
                        'description' => 'Integrasi router MikroTik, pembuatan sistem voucher wifi per jam/hari, halaman login custom brand Anda.',
                        'features' => [
                            'Setting Mikrotik + Billing System',
                            'Custom template login page',
                            'Limitasi kecepatan per user',
                            'Tutorial cetak voucher'
                        ]
                    ],
                ]
            ],
            'network-analyst' => [
                'slug' => 'network-analyst',
                'category_label' => 'LAYANAN 02 . ANALYST',
                'title_prefix' => 'Network',
                'title_italic' => 'Analyst.',
                'description' => 'Audit performa, perencanaan topologi, dan optimasi jaringan korporasi. Cocok untuk kantor yang sudah berjalan tapi sering bermasalah.',
                'form_title' => 'Data Permintaan Audit',
                'form_subtitle' => 'Sesi konsultasi awal gratis sebelum pengerjaan.',
                'submit_button_text' => 'Minta Audit Jaringan',
                'options' => [
                    [
                        'id' => 'audit-performa',
                        'name' => 'Audit Performa',
                        'price' => '850.000',
                        'description' => 'Pemeriksaan jaringan menyeluruh — kecepatan, latency, packet loss, kualitas sinyal — disertai laporan rekomendasi.',
                        'features' => [
                            'Speed test multi-titik',
                            'Heatmap sinyal WiFi',
                            'Identifikasi bottleneck',
                            'Laporan PDF + rekomendasi'
                        ]
                    ],
                    [
                        'id' => 'setup-mikrotik',
                        'name' => 'Setup Mikrotik / Router',
                        'price' => '1.250.000',
                        'is_popular' => true,
                        'description' => 'Konfigurasi router enterprise — VLAN, QoS, firewall, hotspot, voucher. Cocok untuk kantor 20+ user.',
                        'features' => [
                            'Konfigurasi VLAN & QoS',
                            'Firewall & rule keamanan',
                            'Hotspot / voucher (opsional)',
                            'Backup konfigurasi'
                        ]
                    ],
                    [
                        'id' => 'topologi-baru',
                        'name' => 'Perencanaan Topologi Baru',
                        'price' => '2.500.000',
                        'description' => 'Desain ulang infrastruktur jaringan dari nol — denah kabel, daftar perangkat, RAB, fase implementasi.',
                        'features' => [
                            'Site survey + denah lokasi',
                            'Diagram topologi profesional',
                            'RAB perangkat & kabel',
                            'Roadmap implementasi'
                        ]
                    ],
                ]
            ],
            'perawatan-rutin' => [
                'slug' => 'perawatan-rutin',
                'category_label' => 'LAYANAN 03 . MAINTENANCE',
                'title_prefix' => 'Perawatan',
                'title_italic' => 'Rutin.',
                'description' => 'Pengecekan berkala, cleaning, firmware update, troubleshoot, dan laporan kondisi perangkat untuk menjamin kelangsungan operasional.',
                'form_title' => 'Data Registrasi Maintenance',
                'form_subtitle' => 'Paket pemeliharaan preventif berkala terbaik.',
                'submit_button_text' => 'Ajukan Kontrak Maintenance',
                'options' => [
                    [
                        'id' => 'maintenance-standard',
                        'name' => 'Kunjungan Bulanan Standard',
                        'price' => '500.000',
                        'description' => 'Pengecekan berkala 1 kali per bulan untuk memelihara kestabilan jaringan, update firmware, dan backup data router.',
                        'features' => [
                            '1x Kunjungan fisik bulanan',
                            'Update firmware & backup rutin',
                            'Remote support jam kerja',
                            'Laporan bulanan'
                        ]
                    ],
                    [
                        'id' => 'maintenance-pro',
                        'name' => 'Kunjungan Bulanan Pro',
                        'price' => '950.000',
                        'is_popular' => true,
                        'description' => 'Sistem monitoring jaringan aktif, 2 kali kunjungan fisik, remote support prioritas 24/7 untuk bisnis kritikal.',
                        'features' => [
                            '2x Kunjungan fisik bulanan',
                            'Remote support 24/7 (prioritas)',
                            'Monitoring uptime perangkat',
                            'Emergency visit (SLA 4 Jam)'
                        ]
                    ],
                    [
                        'id' => 'ondemand-troubleshoot',
                        'name' => 'On-Demand Troubleshoot',
                        'price' => '250.000',
                        'description' => 'Panggilan sekali datang untuk mendiagnosis masalah jaringan mendadak, penggantian kabel, atau konfigurasi ulang.',
                        'features' => [
                            '1x Panggilan troubleshooting',
                            'Diagnosa hardware & software',
                            'Perbaikan kabel LAN terputus',
                            'Garansi pengerjaan 7 hari'
                        ]
                    ],
                ]
            ],
            'rakit-pc' => [
                'slug' => 'rakit-pc',
                'category_label' => 'LAYANAN 04 . HARDWARE',
                'title_prefix' => 'Rakit & Service',
                'title_italic' => 'PC.',
                'description' => 'Konsultasi spesifikasi, perakitan profesional, instalasi OS + software, cleaning, upgrade, dan troubleshooting hardware bermasalah.',
                'form_title' => 'Form Pemesanan Rakit / Service',
                'form_subtitle' => 'Sesuaikan budget & kebutuhan spesifikasi Anda.',
                'submit_button_text' => 'Kirim Request Hardware',
                'options' => [
                    [
                        'id' => 'rakit-standard',
                        'name' => 'Jasa Rakit & Install Standard',
                        'price' => '150.000',
                        'description' => 'Rakit rapi, manajemen kabel standar, instalasi Windows non-activated (atau dengan key Anda) & driver terbaru.',
                        'features' => [
                            'Rakit komponen PC standar',
                            'Instalasi OS & driver update',
                            'Cable management rapi',
                            'Stress test kestabilan 30 menit'
                        ]
                    ],
                    [
                        'id' => 'rakit-pro',
                        'name' => 'Jasa Rakit Pro & Watercooling',
                        'price' => '350.000',
                        'is_popular' => true,
                        'description' => 'Perakitan hardware high-end, instalasi AIO/custom watercooling, overclocking ringan, dan management kabel premium aesthetic.',
                        'features' => [
                            'Rakit PC High-End & Gaming',
                            'Instalasi AIO / Air Cooler besar',
                            'Cable routing premium & rapi',
                            'Stress testing & benchmark'
                        ]
                    ],
                    [
                        'id' => 'service-cleaning',
                        'name' => 'Service / Pembersihan Total',
                        'price' => '100.000',
                        'description' => 'PC dibongkar total, dibersihkan dari debu tebal, ganti thermal paste processor premium (Grizzly/MX-4) agar tidak overheat.',
                        'features' => [
                            'Deep cleaning debu komponen',
                            'Repaste thermal paste premium',
                            'Pengecekan suhu sebelum & sesudah',
                            'Optimasi OS & startup program'
                        ]
                    ],
                ]
            ],
            'desain-grafis' => [
                'slug' => 'desain-grafis',
                'category_label' => 'LAYANAN 05 . DESIGN',
                'title_prefix' => 'Desain',
                'title_italic' => 'Grafis.',
                'description' => 'Visual branding premium, pembuatan logo, banner, kemasan, katalog, dan konten media sosial yang siap menarik perhatian konsumen.',
                'form_title' => 'Form Brief Desain Kreatif',
                'form_subtitle' => 'Tuangkan konsep ide & visi brand Anda.',
                'submit_button_text' => 'Mulai Project Desain',
                'options' => [
                    [
                        'id' => 'design-logo',
                        'name' => 'Desain Logo & Identity',
                        'price' => '450.000',
                        'description' => 'Pembuatan konsep logo profesional, filosofi warna, aturan tipografi, dan file siap pakai resolusi tinggi.',
                        'features' => [
                            '3 Pilihan alternatif konsep',
                            'Revisi minor sampai 3x',
                            'Master file vector (AI, EPS, PDF)',
                            'Format siap pakai (PNG & SVG)'
                        ]
                    ],
                    [
                        'id' => 'design-branding',
                        'name' => 'Branding Kit Lengkap',
                        'price' => '1.200.000',
                        'is_popular' => true,
                        'description' => 'Paket identitas visual lengkap dari logo, stationery, banner media sosial, hingga template marketing kit usaha Anda.',
                        'features' => [
                            'Desain Logo & Brand Guideline',
                            'Kartu nama, KOP surat, Amplop',
                            '3 Template feeds Instagram',
                            'Desain spanduk / banner toko'
                        ]
                    ],
                    [
                        'id' => 'design-promo',
                        'name' => 'Desain Promosi / Banner',
                        'price' => '150.000',
                        'description' => 'Desain media promosi cetak maupun digital beresolusi tinggi, siap kirim ke percetakan.',
                        'features' => [
                            'Desain Banner / MMT / Brosur',
                            'Desain layout infografis / menu',
                            'File siap cetak (TIFF / PDF)',
                            'Revisi cepat 2x'
                        ]
                    ],
                ]
            ],
            'printing-cetak' => [
                'slug' => 'printing-cetak',
                'category_label' => 'LAYANAN 06 . PRINT',
                'title_prefix' => 'Printing &',
                'title_italic' => 'Cetak.',
                'description' => 'Cetak dokumen, banner, stiker, brosur, foto dengan kualitas tinta tajam, warna akurat, dan pilihan bahan premium.',
                'form_title' => 'Data Pemesanan Cetak',
                'form_subtitle' => 'Kirim file desain Anda dan pilih detail material.',
                'submit_button_text' => 'Kirim Order Cetak',
                'options' => [
                    [
                        'id' => 'print-banner',
                        'name' => 'Cetak Banner / Spanduk',
                        'price' => '25.000',
                        'description' => 'Cetak banner luar ruangan (outdoor) atau dalam ruangan dengan ketebalan bahan bervariasi sesuai budget.',
                        'features' => [
                            'Bahan Flexi Standard 280gsm',
                            'Cetak resolusi tinggi',
                            'Finishing mata ayam pojok-pojok',
                            'Harga terhitung per meter persegi'
                        ]
                    ],
                    [
                        'id' => 'print-stiker',
                        'name' => 'Cetak Stiker Label',
                        'price' => '15.000',
                        'is_popular' => true,
                        'description' => 'Cetak label kemasan produk per lembar A3. Bahan stiker tahan air (Vinyl) atau ekonomis (Cromo).',
                        'features' => [
                            'Cetak lembaran kertas A3+',
                            'Bahan Vinyl Glossy/Doff/Cromo',
                            'Kiss-Cut (setengah putus) bebas pola',
                            'Tinta anti luntur & tahan air'
                        ]
                    ],
                    [
                        'id' => 'print-brosur',
                        'name' => 'Cetak Brosur / Leaflet',
                        'price' => '120.000',
                        'description' => 'Cetak brosur full color 2 sisi lipat 3 atau standard. Sangat pas untuk menu makanan dan promosi event.',
                        'features' => [
                            '1 Rim (isi ±500 lembar)',
                            'Bahan premium Art Paper 150gsm',
                            'Cetak full color offset laser',
                            'Finishing potong rapi'
                        ]
                    ],
                ]
            ],
        ];
    }

    /**
     * Show service details page with form
     */
    public function show($slug)
    {
        $services = $this->getServices();

        // Fallback to network-analyst if service slug not found
        if (!array_key_exists($slug, $services)) {
            return redirect()->route('layanan.show', ['slug' => 'network-analyst']);
        }

        $service = $services[$slug];

        return view('pages.layanan-detail', compact('service'));
    }

    /**
     * Store service order form submission
     */
    public function store(Request $request, $slug)
    {
        $services = $this->getServices();

        if (!array_key_exists($slug, $services)) {
            return redirect()->back()->with('error', 'Layanan tidak valid.');
        }

        $service = $services[$slug];

        // Validate basic inputs required for all orders
        $rules = [
            'package_selected' => 'required|string',
            'nama_perusahaan' => 'required|string|max:255',
            'no_whatsapp' => 'required|string|max:50',
            'email_kerja' => 'required|email|max:255',
            'masalah_utama' => 'required|string',
        ];

        // Add additional optional validation depending on active forms
        if ($slug === 'network-analyst' || $slug === 'perawatan-rutin') {
            $rules['alamat_lokasi'] = 'required|string';
        }

        $validated = $request->validate($rules);

        // Gather all fields that are not in the main table to save in custom_fields
        $allInputs = $request->all();
        $baseFields = ['_token', 'package_selected', 'nama_perusahaan', 'no_whatsapp', 'email_kerja', 'masalah_utama', 'alamat_lokasi', 'jumlah_karyawan', 'jumlah_lokasi', 'perangkat_utama'];
        $customFields = array_diff_key($allInputs, array_flip($baseFields));

        $orderData = [
            'service_slug' => $slug,
            'package_selected' => $validated['package_selected'],
            'nama_perusahaan' => $validated['nama_perusahaan'],
            'no_whatsapp' => $validated['no_whatsapp'],
            'email_kerja' => $validated['email_kerja'],
            'jumlah_karyawan' => $request->input('jumlah_karyawan'),
            'jumlah_lokasi' => $request->input('jumlah_lokasi'),
            'perangkat_utama' => $request->input('perangkat_utama'),
            'masalah_utama' => $validated['masalah_utama'],
            'alamat_lokasi' => $request->input('alamat_lokasi'),
            'custom_fields' => $customFields,
            'status' => 'pending',
        ];

        $databaseReady = false;
        $savedToDb = false;

        try {
            // Check if connection works and the table exists
            if (Schema::hasTable('orders')) {
                $order = Order::create($orderData);
                $savedToDb = true;
                $databaseReady = true;
            }
        } catch (\Exception $e) {
            Log::warning("Order could not be saved to database: " . $e->getMessage());
        }

        // IMPORTANT: Save order to session's orders_db if user is logged in (SKIP DATABASE as per requirement)
        if (session()->has('user')) {
            $ordersDb = session('orders_db', []);
            
            // Create order entry with mock ID and status
            $newOrder = [
                'id' => rand(1000, 9999),
                'service_slug' => $slug,
                'package_selected' => $validated['package_selected'],
                'nama_perusahaan' => $validated['nama_perusahaan'],
                'no_whatsapp' => $validated['no_whatsapp'],
                'email_kerja' => $validated['email_kerja'],
                'masalah_utama' => $validated['masalah_utama'],
                'price' => $this->getPackagePrice($slug, $validated['package_selected']),
                'date' => now()->format('d M Y'),
                'status' => 'masuk', // Newly submitted orders start with 'masuk' status
                'payment_status' => 'belum_bayar' // Default payment status for new orders
            ];
            
            $ordersDb[] = $newOrder;
            session(['orders_db' => $ordersDb]);
        }

        // Store standard preview in session for user visual confirmation without active DB
        session()->flash('success_order', [
            'service_title' => $service['title_prefix'] . ' ' . str_replace('.', '', $service['title_italic']),
            'package' => $validated['package_selected'],
            'nama' => $validated['nama_perusahaan'],
            'whatsapp' => $validated['no_whatsapp'],
            'email' => $validated['email_kerja'],
            'saved_to_db' => $savedToDb,
            'database_ready' => $databaseReady
        ]);

        return redirect()->back();
    }

    /**
     * Helper: Get package price by service slug and package name
     */
    private function getPackagePrice($serviceSlug, $packageName)
    {
        $services = $this->getServices();
        
        if (!isset($services[$serviceSlug])) {
            return 'Hubungi kami';
        }

        foreach ($services[$serviceSlug]['options'] as $option) {
            if ($option['name'] === $packageName) {
                return $option['price'];
            }
        }

        return 'Hubungi kami';
    }
}

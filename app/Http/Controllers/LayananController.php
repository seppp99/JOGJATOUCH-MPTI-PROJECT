<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests\StoreWifiOrderRequest;
use App\Http\Requests\StoreNetworkOrderRequest;
use App\Http\Requests\StorePerawatanOrderRequest;
use App\Http\Requests\StoreDesainOrderRequest;
use App\Http\Requests\StoreRakitOrderRequest;
use Illuminate\Support\Str;
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
                        'description' => 'Pemeriksaan jaringan menyeluruh â€” kecepatan, latency, packet loss, kualitas sinyal â€” disertai laporan rekomendasi.',
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
                        'description' => 'Konfigurasi router enterprise â€” VLAN, QoS, firewall, hotspot, voucher. Cocok untuk kantor 20+ user.',
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
                        'description' => 'Desain ulang infrastruktur jaringan dari nol â€” denah kabel, daftar perangkat, RAB, fase implementasi.',
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
                'description' => 'Buku Custom, Photobook, dan Cetak Foto hingga ukuran A0.',
                'form_title' => 'Atur & pesan cetakanmu',
                'form_subtitle' => 'Tim JogjaTouch konfirmasi total final & link upload via WhatsApp',
                'submit_button_text' => 'Pesan Cetakan',
                'options' => [
                    [
                        'id' => 'buku-custom',
                        'name' => 'Buku Custom',
                        'category_sub' => 'CETAK . DIGITAL PRINTING',
                        'price' => '25.000',
                        'description' => 'Cetak buku, modul ajar, undangan, atau company profile langsung dari file desainmu â€” softcover atau hardcover dengan beragam pilihan jilid.',
                        'features' => [
                            'Ukuran A4 & B5',
                            'Soft / hard cover',
                            'Lem, jahit, spiral',
                            'Dari file Drive / Canva'
                        ]
                    ],
                    [
                        'id' => 'photobook',
                        'name' => 'Photobook',
                        'category_sub' => 'CETAK . DIGITAL PRINTING',
                        'price' => '299.000',
                        'is_popular' => true,
                        'description' => 'Album foto hardcover premium untuk wisuda, pernikahan, atau kenangan keluarga. Cukup kumpulkan semua foto dalam satu folder Google Drive atau Canva dan kirim linknya, tim desain kami yang menyusun layout-nya dengan rapi dan estetis. Pilih cover laminasi doff, kertas art paper atau glossy, dengan jumlah halaman fleksibel mulai 20 hingga 40 halaman.',
                        'features' => [
                            'A4 landscape premium',
                            'Hardcover premium',
                            'Art / glossy paper',
                            'Layout dibuatkan tim'
                        ]
                    ],
                    [
                        'id' => 'cetak-foto',
                        'name' => 'Cetak Foto',
                        'category_sub' => 'CETAK . FOTO & POSTER',
                        'price' => '500',
                        'description' => 'Cetak foto favoritmu dalam berbagai ukuran, dari 4R untuk album sampai poster raksasa A0 untuk pameran atau dekorasi dinding. Tersedia finishing glossy, matte/doff.',
                        'features' => [
                            '4R hingga A0',
                            'Glossy / matte / luster',
                            'Koreksi warna gratis',
                            'Bisa selesai hari ini'
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

        // For printing-cetak, redirect to WhatsApp with order details
        if ($slug === 'printing-cetak') {
            $package = $validated['package_selected'];
            $lines = [
                "Halo JogjaTouch! Saya ingin memesan cetakan. ðŸ–¨ï¸",
                "",
                "*Produk:* {$package}",
                "*Nama:* " . $validated['nama_perusahaan'],
                "*No. WhatsApp:* " . $validated['no_whatsapp'],
            ];

            // Append product-specific custom fields with readable labels
            $fieldLabels = [
                'jumlah'          => 'Jumlah',
                'ukuran'          => 'Ukuran',
                'ukuran_cetak'    => 'Ukuran Cetak',
                'jenis_cover'     => 'Jenis Cover',
                'penjilidan'      => 'Penjilidan',
                'jumlah_halaman'  => 'Jumlah Halaman',
                'cover'           => 'Cover',
                'kertas_isi'      => 'Kertas Isi',
                'link_folder_foto'=> 'Link Folder Foto',
                'finishing_kertas'=> 'Finishing Kertas',
                'laminasi'        => 'Laminasi',
            ];
            foreach ($fieldLabels as $field => $label) {
                $val = $request->input($field);
                if ($val !== null && $val !== '') {
                    $lines[] = "*{$label}:* {$val}";
                }
            }

            $lines[] = "*Catatan:* " . $validated['masalah_utama'];

            $message = implode("\n", $lines);
            $waNumber = config('services.whatsapp.admin_number', '6282158665638');
            $waUrl = 'https://wa.me/' . $waNumber . '?text=' . rawurlencode($message);

            return redirect($waUrl);
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

        public function storeWifiOrder(StoreWifiOrderRequest $request)
    {
        $validated = $request->validated();
        $orderCode = $this->generateOrderCode('WIFI');

        $order = new Order();
        $order->user_id = auth()->id();
        $order->order_code = $orderCode;
        $order->layanan_id = 'pemasangan-wifi';
        $order->paket_dipilih = $validated['paket_dipilih'];
        $order->nama_pelanggan = $validated['nama_pelanggan'];
        $order->whatsapp_number = $validated['whatsapp_number'];
        $order->email = $validated['email'];
        $order->detail_kebutuhan = $validated['detail_kebutuhan'];
        $order->alamat = $validated['alamat'];
        
        $order->custom_fields = [
            'luas_bangunan' => $validated['luas_bangunan'] ?? null,
            'jumlah_lantai' => $validated['jumlah_lantai'] ?? null,
        ];
        
        $order->save();

        $whatsappUrl = $this->buildWhatsappUrl($order, 'Pemasangan WiFi');
        
        return redirect()->away($whatsappUrl);
    }

    public function storeNetworkOrder(StoreNetworkOrderRequest $request)
    {
        $validated = $request->validated();
        $orderCode = $this->generateOrderCode('NET');

        $order = new Order();
        $order->user_id = auth()->id();
        $order->order_code = $orderCode;
        $order->layanan_id = 'network-analyst';
        $order->paket_dipilih = $validated['paket_dipilih'];
        $order->nama_pelanggan = $validated['nama_pelanggan'];
        $order->whatsapp_number = $validated['whatsapp_number'];
        $order->email = $validated['email'];
        $order->detail_kebutuhan = $validated['detail_kebutuhan'];
        $order->alamat = $validated['alamat'];
        
        $order->custom_fields = [
            'jumlah_karyawan' => $validated['jumlah_karyawan'] ?? null,
            'jumlah_lokasi' => $validated['jumlah_lokasi'] ?? null,
            'perangkat_utama' => $validated['perangkat_utama'] ?? null,
        ];
        
        $order->save();

        $whatsappUrl = $this->buildWhatsappUrl($order, 'Network Analyst');
        
        return redirect()->away($whatsappUrl);
    }

    public function storePerawatanOrder(StorePerawatanOrderRequest $request)
    {
        $validated = $request->validated();
        $orderCode = $this->generateOrderCode('MNT');

        try {
            $order = new Order();
            $order->user_id = auth()->id();
            $order->order_code = $orderCode;
            $order->layanan_id = 'perawatan-rutin';
            $order->paket_dipilih = $validated['paket_dipilih'];
            $order->nama_pelanggan = $validated['nama_pelanggan'];
            $order->whatsapp_number = $validated['whatsapp_number'];
            $order->email = $validated['email'];
            $order->detail_kebutuhan = $validated['detail_kebutuhan'];
            $order->alamat = $validated['alamat'];
            
            $order->custom_fields = [];
            
            $order->save();

            $whatsappUrl = $this->buildWhatsappUrl($order, 'Perawatan Rutin');
            
            return redirect()->away($whatsappUrl);
        } catch (\Exception $e) {
            Log::error('Error saving Perawatan Rutin order: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan pesanan. Silakan coba lagi.')->withInput();
        }
    }

    public function storeDesainOrder(StoreDesainOrderRequest $request)
    {
        $validated = $request->validated();
        $orderCode = $this->generateOrderCode('DSN');

        try {
            $order = new Order();
            $order->user_id = auth()->id();
            $order->order_code = $orderCode;
            $order->layanan_id = 'desain-grafis';
            $order->paket_dipilih = $validated['paket_dipilih'];
            $order->nama_pelanggan = $validated['nama_pelanggan'];
            $order->whatsapp_number = $validated['whatsapp_number'];
            $order->email = $validated['email'];
            $order->detail_kebutuhan = $validated['detail_kebutuhan'];
            $order->alamat = $validated['alamat'];
            
            $order->custom_fields = [];
            
            $order->save();

            $whatsappUrl = $this->buildWhatsappUrl($order, 'Desain Grafis');
            
            return redirect()->away($whatsappUrl);
        } catch (\Exception $e) {
            Log::error('Error saving Desain Grafis order: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan pesanan. Silakan coba lagi.')->withInput();
        }
    }

    public function storeRakitOrder(StoreRakitOrderRequest $request)
    {
        $validated = $request->validated();
        $orderCode = $this->generateOrderCode('RKT');

        try {
            $order = new Order();
            $order->user_id = auth()->id();
            $order->order_code = $orderCode;
            $order->layanan_id = 'rakit-pc';
            $order->paket_dipilih = $validated['paket_dipilih'];
            $order->nama_pelanggan = $validated['nama_pelanggan'];
            $order->whatsapp_number = $validated['whatsapp_number'];
            $order->email = $validated['email'];
            $order->detail_kebutuhan = $validated['detail_kebutuhan'];
            $order->alamat = $validated['alamat'];
            
            $order->custom_fields = [
                'budget_rakit' => $validated['budget_rakit'] ?? null
            ];
            
            $order->save();

            $whatsappUrl = $this->buildWhatsappUrl($order, 'Rakit & Service PC');
            
            return redirect()->away($whatsappUrl);
        } catch (\Exception $e) {
            Log::error('Error saving Rakit PC order: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan pesanan. Silakan coba lagi.')->withInput();
        }
    }
    private function generateOrderCode($prefix)
    {
        return $prefix . '-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -5));
    }

        public function storePrintingBukuOrder(\App\Http\Requests\StorePrintingBukuRequest $request)
    {
        $data = $request->validated();
        try {
            $order = \App\Models\Order::create([
                'user_id'          => auth()->id(),
                'order_code'       => $this->generateOrderCode('PRN'),
                'layanan_id'       => 'printing-cetak',
                'paket_dipilih'    => $data['paket_dipilih'],          // "Buku Custom"
                'nama_pelanggan'   => $data['nama_pelanggan'],          // snapshot
                'whatsapp_number'  => $data['whatsapp_number'],         // snapshot
                'email'            => auth()->user()->email,            // dari AKUN
                'detail_kebutuhan' => $data['detail_kebutuhan'],        // dari Catatan
                // alamat sengaja TIDAK diisi -> NULL (Printing tak punya alamat)
                'custom_fields'    => [
                    'ukuran'         => $data['ukuran'],
                    'jenis_cover'    => $data['jenis_cover'],
                    'penjilidan'     => $data['penjilidan'],
                    'jumlah_halaman' => $data['jumlah_halaman'],
                    'jumlah'         => $data['jumlah'],
                ],
                'status'           => 'pending',
            ]);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Gagal simpan order Printing Buku Custom', ['error'=>$e->getMessage()]);
            return back()->withInput()->with('error','Gagal menyimpan pesanan. Silakan coba lagi.');
        }
        return redirect()->away($this->buildWhatsappUrl($order, 'Printing - Buku Custom'));
    }

    public function storePrintingPhotobookOrder(\App\Http\Requests\StorePrintingPhotobookRequest $request)
    {
        $data = $request->validated();
        try {
            $order = \App\Models\Order::create([
                'user_id'          => auth()->id(),
                'order_code'       => $this->generateOrderCode('PRN'),
                'layanan_id'       => 'printing-cetak',
                'paket_dipilih'    => $data['paket_dipilih'],          // "Photobook"
                'nama_pelanggan'   => $data['nama_pelanggan'],          // snapshot
                'whatsapp_number'  => $data['whatsapp_number'],         // snapshot
                'email'            => auth()->user()->email,            // dari AKUN
                'detail_kebutuhan' => $data['detail_kebutuhan'],        // dari Catatan
                // alamat sengaja TIDAK diisi -> NULL
                'custom_fields'    => [
                    'ukuran'           => $data['ukuran'],
                    'cover'            => $data['cover'],
                    'kertas_isi'       => $data['kertas_isi'],
                    'jumlah_halaman'   => $data['jumlah_halaman'],
                    'link_folder_foto' => $data['link_folder_foto'],
                    'jumlah'           => $data['jumlah'],
                ],
                'status'           => 'pending',
            ]);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Gagal simpan order Printing Photobook', ['error'=>$e->getMessage()]);
            return back()->withInput()->with('error','Gagal menyimpan pesanan. Silakan coba lagi.');
        }
        return redirect()->away($this->buildWhatsappUrl($order, 'Printing - Photobook'));
    }

    private function buildWhatsappUrl($order, $namaLayanan)
    {
        $adminNumber = config('services.whatsapp.admin_number', '6282158665638');
        $message = "Halo Admin Jogjatouch,\n\n";
        $message .= "Saya ingin memesan layanan *{$namaLayanan}*.\n\n";
        $message .= "*Order Code*: {" . $order->order_code . "}\n";
        $message .= "*Paket*: {" . $order->paket_dipilih . "}\n";
        $message .= "*Nama*: {" . $order->nama_pelanggan . "}\n";
        $message .= "*WhatsApp*: {" . $order->whatsapp_number . "}\n";
        $message .= "*Email*: {" . $order->email . "}\n";
        
        $custom = $order->custom_fields ?? [];
        foreach ($custom as $key => $val) {
            if (!empty($val)) {
                $label = Str::title(str_replace('_', ' ', $key));
                // Optional override logic could be here, e.g. $overrides = ['budget_rakit' => 'Budget Rakit PC']
                if ($key === 'luas_bangunan') {
                    $message .= "*{$label}*: {$val} m2\n";
                } else {
                    $message .= "*{$label}*: {$val}\n";
                }
            }
        }
        
        $message .= "*Detail Kebutuhan*:\n{" . $order->detail_kebutuhan . "}\n\n";
        $message .= "*Alamat*:\n{" . $order->alamat . "}";

        return "https://wa.me/" . $adminNumber . "?text=" . rawurlencode($message);
    }
}


<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

echo "--- MOCKING HTTP REQUEST ---\n";

// 1. Setup User
$user = User::firstOrCreate(
    ['email' => 'test_order@example.com'],
    [
        'name' => 'Test User',
        'whatsapp_number' => '081234567890',
        'password' => bcrypt('password')
    ]
);

auth()->login($user);

// Simulate GET request to view the form
$request = Request::create('/layanan/pemasangan-wifi', 'GET');
$response = app()->handle($request);
$content = $response->getContent();

if (strpos($content, 'value="Test User"') !== false && strpos($content, 'value="081234567890"') !== false) {
    echo "1. GET /layanan/pemasangan-wifi -> SUCCESS (Auto-fill terisi)\n";
} else {
    echo "1. GET /layanan/pemasangan-wifi -> FAILED (Auto-fill tidak ditemukan)\n";
}

if (strpos($content, 'action="' . route('layanan.wifi.order') . '"') !== false) {
    echo "2. Form action is correctly set to layanan.wifi.order -> SUCCESS\n";
} else {
    echo "2. Form action is INCORRECT -> FAILED\n";
}

// 3. Simulate POST request
$postData = [
    'paket_dipilih' => 'Paket Hemat',
    'nama_pelanggan' => 'Test User Updated',
    'whatsapp_number' => '0811111111',
    'email' => 'test_order@example.com',
    'luas_bangunan' => '120',
    'jumlah_lantai' => '2',
    'detail_kebutuhan' => 'Butuh router di lantai 2',
    'alamat' => 'Jalan Test No. 1',
    '_token' => csrf_token() // Need token for POST
];

$postRequest = Request::create('/layanan/pemasangan-wifi/order', 'POST', $postData);
// Needs session to pass CSRF
$postRequest->setLaravelSession(session());
$postResponse = app()->handle($postRequest);

if ($postResponse->isRedirect()) {
    echo "3. POST /layanan/pemasangan-wifi/order -> REDIRECTED to: " . $postResponse->getTargetUrl() . "\n";
    if (strpos($postResponse->getTargetUrl(), 'wa.me/6282158665638') !== false) {
        echo "   -> Redirect contains wa.me and correct admin number -> SUCCESS\n";
    }
} else {
    echo "3. POST /layanan/pemasangan-wifi/order -> DID NOT REDIRECT! Status: " . $postResponse->getStatusCode() . "\n";
}

// Check DB
$order = Order::latest()->first();
echo "4. Database Check: " . $order->order_code . " | " . $order->paket_dipilih . " | ";
var_dump($order->custom_fields);

// 5. Check Regression
$reqRakit = Request::create('/layanan/rakit-pc', 'GET');
$respRakit = app()->handle($reqRakit);
if ($respRakit->getStatusCode() == 200 && strpos($respRakit->getContent(), 'action="' . route('layanan.store', 'rakit-pc') . '"') !== false) {
    echo "5. REGRESSION /layanan/rakit-pc -> SUCCESS (Form action lama masih utuh)\n";
} else {
    echo "5. REGRESSION /layanan/rakit-pc -> FAILED\n";
}

// 6. Check Auth Protection
auth()->logout();
$unauthReq = Request::create('/layanan/pemasangan-wifi/order', 'POST', $postData);
$unauthResp = app()->handle($unauthReq);
if ($unauthResp->isRedirect() && strpos($unauthResp->getTargetUrl(), 'login') !== false) {
    echo "6. Auth Protection -> SUCCESS (Redirects to login)\n";
} else {
    echo "6. Auth Protection -> FAILED\n";
}


<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Order;

class OrderWifiTest extends TestCase
{
    // We won't use RefreshDatabase to avoid wiping their manual data, just test normal operations
    
    public function test_wifi_order_flow()
    {
        // 1. Login, buka layanan Pemasangan WiFi
        $user = User::firstOrCreate(
            ['email' => 'test_order@example.com'],
            [
                'name' => 'Test User',
                'whatsapp_number' => '081234567890',
                'password' => bcrypt('password')
            ]
        );

        $this->actingAs($user);

        $response = $this->get('/layanan/pemasangan-wifi');
        $response->assertStatus(200);
        $response->assertSee('value="Test User"', false);
        $response->assertSee('value="081234567890"', false);
        $response->assertSee('value="test_order@example.com"', false);
        $response->assertSee('action="' . route('layanan.wifi.order') . '"', false);

        // 2 & 3. POST submit order
        $postData = [
            'paket_dipilih' => 'Paket Hemat',
            'nama_pelanggan' => 'Test User Updated',
            'whatsapp_number' => '0811111111',
            'email' => 'test_order@example.com',
            'luas_bangunan' => '120',
            'jumlah_lantai' => '2',
            'detail_kebutuhan' => 'Butuh router di lantai 2',
            'alamat' => 'Jalan Test No. 1',
        ];

        $postResponse = $this->post(route('layanan.wifi.order'), $postData);
        
        // Assert redirect to wa.me
        $postResponse->assertRedirectContains('wa.me/6282158665638');
        
        // Assert DB
        $order = Order::latest()->first();
        $this->assertEquals('Test User Updated', $order->nama_pelanggan);
        $this->assertEquals('0811111111', $order->whatsapp_number);
        $this->assertEquals('pemasangan-wifi', $order->layanan_id);
        $this->assertEquals('Paket Hemat', $order->paket_dipilih);
        $this->assertEquals('120', $order->custom_fields['luas_bangunan']);
        $this->assertEquals('2', $order->custom_fields['jumlah_lantai']);

        // 4. REGRESSION test
        $regression1 = $this->get('/layanan/rakit-pc');
        $regression1->assertStatus(200);
        $regression1->assertSee('action="' . route('layanan.store', 'rakit-pc') . '"', false);
        $regression1->assertDontSee('layanan.wifi.order');

        $regression2 = $this->get('/layanan/desain-grafis');
        $regression2->assertStatus(200);
        $regression2->assertSee('action="' . route('layanan.store', 'desain-grafis') . '"', false);

        $regression3 = $this->get('/layanan/perawatan-rutin');
        $regression3->assertStatus(200);
        
        // 5. Proteksi: logout -> submit order WiFi -> diarahkan ke /login
        auth()->logout();
        $unauthResponse = $this->post(route('layanan.wifi.order'), $postData);
        $unauthResponse->assertRedirectContains('login');
    }
}

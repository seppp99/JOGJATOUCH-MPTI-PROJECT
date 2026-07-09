<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Order;

class OrderNetworkAnalystTest extends TestCase
{
    use RefreshDatabase;

    public function test_network_analyst_order_flow()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'whatsapp_number' => '081234567890',
            'email' => 'test_order@example.com',
        ]);

        $this->actingAs($user);

        // 1. Verify auto-fill and render
        $response = $this->get('/layanan/network-analyst');
        $response->assertStatus(200);
        $response->assertSee('value="Test User"', false);
        $response->assertSee('value="081234567890"', false);
        $response->assertSee('value="test_order@example.com"', false);
        $response->assertSee('action="' . route('layanan.network.order') . '"', false);

        // 2. Submit order
        $postData = [
            'paket_dipilih' => 'Setup Mikrotik / Router',
            'nama_pelanggan' => 'Test User Updated',
            'whatsapp_number' => '0811111111',
            'email' => 'test_order@example.com',
            'jumlah_karyawan' => 20,
            'jumlah_lokasi' => 2,
            'perangkat_utama' => 'Mikrotik RB750',
            'detail_kebutuhan' => 'Koneksi lambat saat jam sibuk',
            'alamat' => 'Jalan Test No. 1',
        ];

        $postResponse = $this->post(route('layanan.network.order'), $postData);
        
        // Assert redirect to wa.me with correct texts
        $postResponse->assertRedirectContains('wa.me/6282158665638');
        $postResponse->assertRedirectContains(rawurlencode('Network Analyst'));
        $postResponse->assertRedirectContains(rawurlencode('Setup Mikrotik / Router'));
        $postResponse->assertRedirectContains(rawurlencode('Jumlah Karyawan'));
        $postResponse->assertRedirectContains(rawurlencode('Jumlah Lokasi'));
        $postResponse->assertRedirectContains(rawurlencode('Perangkat Utama'));
        $postResponse->assertRedirectContains(rawurlencode('Koneksi lambat saat jam sibuk'));
        
        // Assert DB
        $order = Order::latest()->first();
        $this->assertEquals('network-analyst', $order->layanan_id);
        $this->assertEquals('Setup Mikrotik / Router', $order->paket_dipilih);
        $this->assertIsArray($order->custom_fields);
        $this->assertEquals(20, $order->custom_fields['jumlah_karyawan']);
        $this->assertEquals('Mikrotik RB750', $order->custom_fields['perangkat_utama']);
    }

    public function test_auth_protection()
    {
        $response = $this->post(route('layanan.network.order'), []);
        $response->assertRedirect('/login');
    }

    public function test_regression_other_services()
    {
        $services = ['rakit-pc', 'desain-grafis', 'perawatan-rutin'];
        foreach ($services as $slug) {
            $response = $this->get('/layanan/' . $slug);
            $response->assertStatus(200);
        }
    }
}

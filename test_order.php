<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Facades\Route;

echo "--- START TEST ---\n";

// 1. Create a dummy user
$user = User::firstOrCreate(
    ['email' => 'test_order@example.com'],
    [
        'name' => 'Test User',
        'whatsapp_number' => '081234567890',
        'password' => bcrypt('password')
    ]
);

// We will use Laravel's internal testing traits via a temporary test case

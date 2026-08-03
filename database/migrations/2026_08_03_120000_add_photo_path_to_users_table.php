<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menyimpan PATH RELATIF di disk 'public' (mis. "profile-photos/abc.jpg"),
     * bukan URL penuh. Alasannya URL bisa berubah (domain, APP_URL, pindah ke
     * S3), sedangkan path relatif tetap valid.
     *
     * Nullable karena foto profil opsional - null berarti pengguna memakai
     * avatar inisial.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('photo_path')->nullable()->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('photo_path');
        });
    }
};

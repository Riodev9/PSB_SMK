<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pendaftar', function (Blueprint $table) {
            $table->enum('jurusan', [
                'TKJ (Teknik Komputer dan Jaringan)',
                'MM (Multimedia)',
                'OTKP (Otomatisasi Tata Kelola Perkantoran)',
            ])->nullable()->after('status_pendaftaran');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftar', function (Blueprint $table) {
            $table->string('jurusan')->nullable()->change();
        });
    }

};

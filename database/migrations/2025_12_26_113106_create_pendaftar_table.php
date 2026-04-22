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
        Schema::create('pendaftar', function (Blueprint $table) {
            $table->id('id_pendaftar');

            $table->foreignId('id')
                ->constrained('users', 'id')
                ->cascadeOnDelete();

            $table->foreignId('id_tahun')
                ->constrained('tahun_ajaran', 'id_tahun');

            $table->string('nisn')->unique();
            $table->string('nik')->unique();
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('sekolah_asal');

            $table->enum('status_pendaftaran', [
                'draft',
                'dikirim',
                'diterima',
                'ditolak'
            ])->default('draft');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftar');
    }
};

@extends('layouts.halaman')

@section('content')
<div class="bg-slate-900/65 backdrop-blur-xl
            border border-white/20
            rounded-2xl shadow-xl
            p-8 text-white">

    <!-- Header -->
    <h2 class="text-2xl font-semibold mb-2">
        Alur Pendaftaran Peserta Didik Baru
    </h2>
    <p class="text-white/70 mb-6">
        Ikuti tahapan berikut dengan benar agar proses pendaftaran Anda berjalan lancar.
    </p>

    <!-- Steps -->
    <div class="grid gap-4">

        <!-- Step 1 -->
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 flex items-center justify-center
                        rounded-full bg-white/20 font-bold">
                1
            </div>
            <div>
                <h3 class="font-semibold text-lg">Lengkapi Data Diri</h3>
                <p class="text-white/70 text-sm">
                    Isi data pribadi Anda secara lengkap dan sesuai dengan identitas resmi.
                </p>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 flex items-center justify-center
                        rounded-full bg-white/20 font-bold">
                2
            </div>
            <div>
                <h3 class="font-semibold text-lg">Masuk ke Menu Pendaftaran</h3>
                <p class="text-white/70 text-sm">
                    Setelah data diri lengkap, lanjutkan ke menu pendaftaran.
                </p>
            </div>
        </div>

        <!-- Step 3 -->
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 flex items-center justify-center
                        rounded-full bg-white/20 font-bold">
                3
            </div>
            <div>
                <h3 class="font-semibold text-lg">Unggah Berkas Persyaratan</h3>
                <p class="text-white/70 text-sm">
                    Upload seluruh berkas yang diminta dengan format dan ukuran yang benar.
                </p>
            </div>
        </div>

        <!-- Step 4 -->
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 flex items-center justify-center
                        rounded-full bg-white/20 font-bold">
                4
            </div>
            <div>
                <h3 class="font-semibold text-lg">Pilih Jurusan</h3>
                <p class="text-white/70 text-sm">
                    Tentukan jurusan sesuai minat dan kemampuan Anda.
                </p>
            </div>
        </div>

        <!-- Step 5 -->
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 flex items-center justify-center
                        rounded-full bg-white/20 font-bold">
                5
            </div>
            <div>
                <h3 class="font-semibold text-lg">Kirim Pendaftaran</h3>
                <p class="text-white/70 text-sm">
                    Klik tombol <span class="font-medium">Daftar</span> dan tunggu proses verifikasi dari panitia.
                </p>
            </div>
        </div>

    </div>

    <!-- Footer Info -->
    <div class="mt-6 text-sm text-white/60 border-t border-white/20 pt-4">
        Status pendaftaran dan pengumuman hasil seleksi dapat dilihat melalui menu pendaftaran.
    </div>
</div>
@endsection
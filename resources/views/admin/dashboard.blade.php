@extends('layouts.halaman')

@section('content')
    <div class="py-6 mx-1">
        <!-- Card Main -->
        <div class="bg-slate-900/65 backdrop-blur-xl border border-slate-800 rounded-2xl p-8 shadow-lg max-w-7xl h-auto mx-auto">
            
            <!-- Card Kecil di dalam -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-20">
            
            <!-- Card 1: Peserta -->
            <div class="bg-yellow-500 backdrop-blur-lg
                        border border-indigo-300/20
                        rounded-xl p-6 shadow
                        flex flex-col items-center justify-center">

                <h2 class="text-white text-lg font-semibold mb-2 text-center">
                    Peserta Sedang Mendaftar
                </h2>

                <p class="text-3xl font-bold text-white">
                    {{ $jumlahPeserta }}
                </p>

                @if($tahunAktif)
                    <span class="mt-2 text-lg text-white/80">
                        Tahun Ajaran {{ \Carbon\Carbon::parse($tahunAktif->tahun)->format('Y') }}
                    </span>
                @endif
            </div>


            <!-- Card 2: Hari & Tanggal -->
            <div class="bg-teal-500 rounded-xl p-6 shadow flex flex-col items-center justify-center">
                <h2 class="text-white text-xl font-semibold mb-2">
                    Hari & Tanggal
                </h2>
                <p class="text-2xl font-medium text-white">
                    {{ $tanggalHari }}
                </p>
            </div>

            </div>
            <!-- Welcome Text -->
            <h2 class="text-white/80 mb-24 text-center text-2xl leading-snug">
                "Selamat datang di sistem penerimaan siswa baru <br> SMK TEKNOLOGI OBI"
            </h2>
        </div>

    </div>
@endsection
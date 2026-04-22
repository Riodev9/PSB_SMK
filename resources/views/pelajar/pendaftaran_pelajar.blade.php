@extends('layouts.halaman')

@section('content')
<div class="max-w-auto text-slate-800 font-inter mx-auto space-y-6">

    {{-- ALERT --}}
    @if(session('success'))
        <div class="bg-white/70 backdrop-blur-xl
                    border border-emerald-200
                    text-emerald-700 p-4 rounded-2xl shadow">
            {{ session('success') }}
        </div>
    @endif

    {{-- PENDAFTARAN DIBUKA --}}
    @if($tahunAktif)
        <div class="bg-white/80 backdrop-blur-2xl
                    border border-white/60
                    rounded-2xl shadow-[0_20px_40px_rgba(0,0,0,0.12)]
                    p-6">

            <h2 class="text-lg font-semibold text-slate-900">
                Pendaftaran Siswa Baru
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Tahun Ajaran {{ $tahunAktif->tahun }}
            </p>

            <p class="mt-4 text-sm text-slate-700">
                Kuota tersisa:
                <span class="font-semibold text-slate-900">
                    {{ $tahunAktif->kuota }}
                </span>
                siswa
            </p>

            {{-- BELUM ISI DATA DIRI --}}
            @if(!$pendaftar)
                <div class="mt-6 bg-amber-50 border border-amber-200 p-4 rounded-xl text-amber-700">
                    <p class="font-semibold">Lengkapi Data Diri</p>
                    <p class="text-sm mt-1">
                        Silakan lengkapi data diri terlebih dahulu melalui menu
                        <b>Data Diri</b> sebelum melakukan pendaftaran.
                    </p>
                </div>

            {{-- SUDAH DAFTAR (STATUS PRIORITAS PALING ATAS) --}}
            @elseif(!in_array($pendaftar->status_pendaftaran, [null, 'draft']))
                <div class="mt-6 bg-emerald-50 border border-emerald-200 p-4 rounded-xl text-emerald-700">
                    <p><b>Status:</b> {{ ucfirst($pendaftar->status_pendaftaran) }}</p>
                    <p><b>Jurusan:</b> {{ $pendaftar->jurusan }}</p>
                </div>

            {{-- KUOTA HABIS (HANYA UNTUK YANG BELUM DAFTAR) --}}
            @elseif($tahunAktif->kuota <= 0)
                <div class="mt-6 bg-red-50 border border-red-200 p-4 rounded-xl text-red-700">
                    <p class="font-semibold">Pendaftaran Ditutup</p>
                    <p class="text-sm mt-1">
                        Kuota pendaftaran untuk tahun ajaran ini sudah terpenuhi.
                    </p>
                </div>

            {{-- BOLEH DAFTAR --}}
            @else
                <form action="{{ route('pelajar.pendaftaran_pelajar.daftar') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="mt-6 space-y-5">
                    @csrf
                    <!-- Pilih Jurusan --> 
                        <div> 
                            <label class="text-sm text-slate-700">Pilih Jurusan</label> 
                            <select name="jurusan" class="w-full mt-1 px-4 py-2 rounded-xl
                             bg-white/70 backdrop-blur border border-slate-300 text-slate-800 focus:outline-none focus:ring-2
                              focus:ring-slate-400"> 
                                <option value="">-- Pilih Jurusan --</option> 
                                <option value="TKJ (Teknik Komputer dan Jaringan)">
                                TKJ (Teknik Komputer dan Jaringan)</option>
                                <option value="MM (Multimedia)">MM (Multimedia)</option>
                                <option value="OTKP (Otomatisasi Tata Kelola Perkantoran)">
                                OTKP (Otomatisasi Tata Kelola Perkantoran)</option>
                            </select> @error('jurusan') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror 
                        </div> 
                        <!-- Upload Ijazah --> 
                        <div>
                            <label class="text-sm text-slate-700">Fotocopy Ijazah / SKL</label>
                            <input type="file" name="ijazah" class="w-full mt-1 px-3 py-2 rounded-xl
                            bg-white/70 backdrop-blur border border-slate-300 text-slate-700">
                            @error('ijazah') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror 
                        </div> 
                        <!-- Upload KK --> 
                        <div>
                            <label class="text-sm text-slate-700">Fotocopy KK</label>
                            <input type="file" name="kk" class="w-full mt-1 px-3 py-2 rounded-xl
                            bg-white/70 backdrop-blur border border-slate-300 text-slate-700"> @error('kk') 
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror 
                        </div> 
                        <button type="submit" class="w-full mt-4 py-3 rounded-xl bg-slate-900
                         text-white hover:bg-slate-800 font-semibold transition"> 
                            Daftar Sekarang 
                        </button>
                </form>
            @endif

        </div>
    @else
        <div class="bg-red-50 backdrop-blur
                    border border-red-200
                    text-red-700 p-4 rounded-2xl">
            Pendaftaran belum dibuka.
        </div>
    @endif

</div>
@endsection
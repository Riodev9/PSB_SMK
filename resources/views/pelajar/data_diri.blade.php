@extends('layouts.halaman')

@section('content')
<div class="bg-slate-900/65 backdrop-blur-xl border border-slate-800 rounded-2xl p-6 shadow-lg max-w-7xl h-auto mx-auto">
    <div class="max-w-5xl mx-auto space-y-6 mb-10 text-slate-800">
        {{-- HEADER --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold mt-2 text-white">Data Diri Pendaftar</h1>
                <p class="text-sm mb-4 text-slate-300">
                    Lengkapi data diri sebelum melanjutkan pendaftaran
                </p>
            </div>

            <span class="px-3 py-1 rounded-full text-sm
                {{ $tahunAktif ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                {{ $tahunAktif ? 'Pendaftaran Dibuka (' . $tahunAktif->tahun . ')' : 'Pendaftaran Ditutup' }}
            </span>
        </div>

        {{-- ALERT --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if(!$tahunAktif)
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg">
                Saat ini tidak ada pendaftaran aktif.
            </div>
        @else
        
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        {{-- FORM --}}
        <form action="{{ route('pelajar.data_diri.store') }}" method="POST"
            class="bg-white rounded-xl shadow p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
            @csrf

            {{-- Nama --}}
            <div>
                <label class="text-sm">Nama Lengkap</label>
                <input type="text" name="nama_lengkap"
                    value="{{ old('nama_lengkap', $pendaftar->nama_lengkap ?? '') }}"
                    class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200"
                    placeholder="Nama lengkap sesuai ijazah">
                @error('nama_lengkap')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- NISN --}}
            <div>
                <label class="text-sm">NISN</label>
                <input type="text" name="nisn" maxlength="10"
                    value="{{ old('nisn', $pendaftar->nisn ?? '') }}"
                    class="w-full border rounded-lg px-4 py-2"
                    placeholder="10 digit NISN">

                @error('nisn')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- NIK --}}
            <div>
                <label class="text-sm">NIK</label>
                <input type="text" name="nik" maxlength="16"
                    value="{{ old('nik', $pendaftar->nik ?? '') }}"
                    class="w-full border rounded-lg px-4 py-2"
                    placeholder="16 digit NIK">

                <p class="text-xs text-slate-500 mt-1">
                    ! NIK harus terdiri dari <strong>16 digit angka</strong>
                </p>

                @error('nik')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jenis Kelamin --}}
            <div>
                <label class="text-sm">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="w-full border rounded-lg px-4 py-2">
                    <option value="">-- Pilih --</option>
                    <option value="L"
                        {{ old('jenis_kelamin', $pendaftar->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>
                        Laki-laki
                    </option>
                    <option value="P"
                        {{ old('jenis_kelamin', $pendaftar->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>
                        Perempuan
                    </option>
                </select>
            </div>

            {{-- Tanggal Lahir --}}
            <div>
                <label class="text-sm">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir"
                    value="{{ old('tanggal_lahir', $pendaftar->tanggal_lahir ?? '') }}"
                    class="w-full border rounded-lg px-4 py-2">
            </div>

            {{-- No HP --}}
            <div>
                <label class="text-sm">No HP</label>
                <input type="text" name="no_hp"
                    value="{{ old('no_hp', $pendaftar->no_hp ?? '') }}"
                    class="w-full border rounded-lg px-4 py-2">
            </div>

            {{-- Sekolah --}}
            <div class="md:col-span-2">
                <label class="text-sm">Sekolah Asal</label>
                <input type="text" name="sekolah_asal"
                    value="{{ old('sekolah_asal', $pendaftar->sekolah_asal ?? '') }}"
                    class="w-full border rounded-lg px-4 py-2">
            </div>

            {{-- Alamat --}}
            <div class="md:col-span-2">
                <label class="text-sm">Alamat</label>
                <textarea name="alamat" rows="3"
                        class="w-full border rounded-lg px-4 py-2">{{ old('alamat', $pendaftar->alamat ?? '') }}</textarea>
            </div>

            {{-- BUTTON --}}
            <div class="md:col-span-2 flex justify-end">
                <button class="bg-blue-600 text-white px-6 py-2 rounded-2xl hover:bg-blue-700">
                    Simpan Data Diri
                </button>
            </div>
        </form>
        @endif
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
@endsection

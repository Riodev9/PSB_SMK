@extends('layouts.halaman')

@section('content')
<div class="max-w-6xl bg-slate-900/65 rounded-xl mx-auto p-6 space-y-8">
    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <h1 class="text-2xl font-semibold text-white">
            Informasi Pendaftaran
        </h1>

        {{-- FILTER TAHUN --}}
        <form method="GET">
            <select name="tahun_ajaran_id"
                    onchange="this.form.submit()"
                    class="border rounded-lg w-20 px-4 py-2 text-sm
                           focus:ring focus:ring-blue-200">
                @foreach($tahunAjaran as $tahun)
                    <option value="{{ $tahun->id_tahun }}"
                        {{ $tahunId == $tahun->id_tahun ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::parse($tahun->tahun)->format('Y') }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    {{-- FORM TAMBAH INFORMASI --}}
    <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="font-semibold text-lg mb-4 text-slate-700">
            Tambah Informasi Baru
        </h2>

        <form method="POST"
              action="{{ route('admin.informasi.store') }}"
              class="space-y-4">
            @csrf
            <input type="hidden" name="id_tahun" value="{{ $tahunId }}">

            <div>
                <label class="text-sm text-slate-600">Judul Informasi</label>
                <input type="text"
                       name="judul"
                       class="w-full mt-1 border rounded-xl px-4 py-2
                              focus:ring focus:ring-blue-200"
                       placeholder="Contoh: Jadwal Seleksi">
            </div>

            <div>
                <label class="text-sm text-slate-600">Isi Informasi</label>
                <textarea name="isi"
                          rows="4"
                          class="w-full mt-1 border rounded-xl px-4 py-2
                                 focus:ring focus:ring-blue-200"
                          placeholder="Tuliskan isi informasi di sini..."></textarea>
            </div>

            <button class="inline-flex items-center gap-2
                           bg-blue-600 hover:bg-blue-700
                           text-white px-5 py-2 rounded-xl
                           text-sm font-medium transition">
                + Tambah Informasi
            </button>
        </form>
    </div>

    {{-- LIST INFORMASI --}}
    <div>
        <h2 class="font-semibold text-lg mb-4 text-white">
            Daftar Informasi
        </h2>

        <div class="grid gap-5 md:grid-cols-2">
            @forelse($informasi as $info)
                <div class="bg-white rounded-2xl shadow p-5 relative">

                    {{-- DELETE --}}
                    <form method="POST"
                          action="{{ route('admin.informasi.destroy', $info->id_informasi) }}"
                          class="absolute top-3 right-3">
                        @csrf
                        @method('DELETE')
                        <button
                            class="text-slate-400 hover:text-red-500
                                   text-sm transition"
                            title="Hapus">
                            ✕
                        </button>
                    </form>

                    <h3 class="font-semibold text-slate-800 text-lg">
                        {{ $info->judul }}
                    </h3>

                    <p class="text-slate-600 mt-2 text-sm leading-relaxed whitespace-pre-line">
                        {{ $info->isi }}
                    </p>

                    <p class="mt-4 text-xs text-slate-400">
                        Tahun Ajaran
                        {{ \Carbon\Carbon::parse($info->tahunAjaran->tahun)->format('Y') }}
                    </p>
                </div>
            @empty
                <div class="col-span-full text-center py-10 text-slate-500">
                    <p class="text-sm">
                        Belum ada informasi untuk tahun ajaran ini.
                    </p>
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection

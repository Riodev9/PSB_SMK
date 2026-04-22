@extends('layouts.halaman')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="bg-white rounded-2xl shadow-lg p-6">

        <!-- HEADER -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-display font-inter text-slate-800">
                Daftar Berkas Pendaftar
            </h1>

            <!-- Filter Tahun -->
            <form method="GET" action="{{ route('admin.berkas') }}">
                <select name="tahun_ajaran_id"
                        onchange="this.form.submit()"
                        class="border border-slate-300 rounded-lg px-3 py-2 w-44 text-sm focus:ring focus:ring-blue-200">
                    @foreach($tahunAjarans as $tahun)
                        <option value="{{ $tahun->id_tahun }}"
                            {{ $tahunId == $tahun->id_tahun ? 'selected' : '' }}>
                            Tahun Ajaran {{ \Carbon\Carbon::parse($tahun->tahun)->year }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        {{--search dan perpage--}}
        <form method="GET" class="flex gap-2 mb-4">
            <input type="text" name="q" value="{{ request('q') }}"
                class="border rounded px-3 py-2"
                placeholder="Cari nama / NISN">

            <select name="perpage" onchange="this.form.submit()"
                class="border rounded px-3 w-16 py-2">
                @foreach ([10,25,50] as $n)
                    <option value="{{ $n }}" @selected(request('perpage')==$n)>
                        {{ $n }}
                    </option>
                @endforeach
            </select>

            <input type="hidden" name="tahun_ajaran_id" value="{{ $tahunId }}">
        </form>
        <!-- TABLE -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm border border-slate-200 rounded-lg overflow-hidden">
                <thead class="bg-slate-100 text-slate-700">
                    <tr>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">NISN</th>
                        <th class="px-4 py-3 text-left">Berkas</th>
                        <th class="px-4 py-3 text-left">Catatan</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse($pendaftars as $pendaftar)
                        @php
                            $ijazah = $pendaftar->berkas->firstWhere('jenis_file', 'Ijazah/SKL');
                            $kk = $pendaftar->berkas->firstWhere('jenis_file', 'kk');
                        @endphp

                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-4 py-3 font-medium text-slate-800">
                                {{ $pendaftar->nama_lengkap }}
                            </td>

                            <td class="px-4 py-3 font-medium text-slate-600">
                                {{ $pendaftar->nisn }}
                            </td>

                            <!-- BERKAS -->
                            <td class="px-4 py-3 space-y-2">
                                <div class="flex items-center gap-2">
                                    <span class="text-slate-700 font-medium w-28">
                                        Ijazah/SKL
                                    </span>
                                    @if($ijazah?->file_path)
                                        <a href="{{ asset('storage/'.$ijazah->file_path) }}"
                                           target="_blank"
                                           class="text-blue-600 hover:underline text-sm">
                                            Lihat
                                        </a>
                                    @else
                                        <span class="text-slate-400 text-sm">
                                            Belum upload
                                        </span>
                                    @endif
                                </div>

                                <div class="flex items-center gap-2">
                                    <span class="text-slate-700 font-medium w-28">
                                        KK
                                    </span>
                                    @if($kk?->file_path)
                                        <a href="{{ asset('storage/'.$kk->file_path) }}"
                                           target="_blank"
                                           class="text-blue-600 hover:underline text-sm">
                                            Lihat
                                        </a>
                                    @else
                                        <span class="text-slate-400 text-sm">
                                            Belum upload
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <!-- CATATAN -->
                            <td class="px-4 py-3">
                                <form method="POST"
                                      action="{{ route('admin.berkas.catatan', $pendaftar->id_pendaftar) }}"
                                      class="flex gap-2">
                                    @csrf
                                    <input type="text"
                                           name="catatan"
                                           value="{{ $pendaftar->berkas->first()?->catatan ?? '' }}"
                                           placeholder="Isi catatan"
                                           class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring focus:ring-blue-200">
                                    <button class="bg-green-600 hover:bg-green-700 text-white px-4 rounded-lg text-sm">
                                        Simpan
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-slate-500">
                                Belum ada data berkas
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{ $pendaftars->links('pagination::tailwind') }}
            </div>
        </div>

    </div>
</div>

@endsection

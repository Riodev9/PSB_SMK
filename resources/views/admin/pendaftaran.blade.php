@extends('layouts.halaman')

@section('content')
    <div class="py-6 mx-1">
    <!-- Card Main -->
        <div class="bg-slate-900/65 backdrop-blur-xl border border-slate-800 rounded-2xl p-8 shadow-lg max-w-7xl h-auto mx-auto">
            <h1 class="text-xl text-white font-semibold mb-4">Pendaftaran Siswa Baru</h1>
                @if($tahunAktif)
                    <p class="mb-4 text-white">
                        Tahun Ajaran Aktif:
                        <strong>{{ $tahunAktif->tahun }}</strong>
                    </p>
                @endif

                {{--tambahan--}}
                <div class="flex flex-wrap justify-between items-center mb-4 gap-3">
                    <!-- SEARCH -->
                    <form method="GET">
                        <input type="text"
                            name="q"
                            value="{{ request('q') }}"
                            placeholder="Cari nama / jurusan / status"
                            class="border px-3 py-2 rounded-lg text-sm">
                    </form>

                    <!-- PER PAGE -->
                    <form method="GET">
                        <input type="hidden" name="q" value="{{ request('q') }}">
                        <select name="per_page"
                                onchange="this.form.submit()"
                                class="border px-3 py-2 rounded-lg w-28 text-sm">
                            @foreach([10,25,50,100] as $n)
                                <option value="{{ $n }}" {{ request('per_page',10)==$n?'selected':'' }}>
                                    {{ $n }} data
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div x-data="{ open: false, data: null }">
                    <table class="w-full bg-white rounded-xl shadow text-sm">
                        <thead>
                            <tr>
                                <th class="p-3">Nama</th>
                                <th class="p-3">Jurusan</th>
                                <th class="p-3">Status</th>
                                <th class="p-3 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($pendaftar as $p)
                            <tr class="border-t">
                                <td class="p-3">{{ $p->nama_lengkap }}</td>
                                <td class="p-3">{{ $p->jurusan }}</td>
                                <td class="p-3">{{ ucfirst($p->status_pendaftaran) }}</td>
                                <td class="p-3 text-center">
                                    <button
                                        @click="
                                            open = true;
                                            data = {{ Js::from($p) }}
                                        "
                                        class="bg-slate-800 text-white px-4 py-1.5 rounded-lg text-xs hover:bg-slate-900">
                                        Lihat Detail
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-4 text-center text-gray-500">
                                    Belum ada pendaftar
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div
                        x-show="open"
                        x-transition.opacity
                        x-cloak
                        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
                    >
                        <div
                            @click.outside="open = false"
                            class="bg-white w-full mt-28 max-w-3xl rounded-2xl shadow-xl p-6"
                        >

                            <h2 class="text-lg font-semibold mb-6">
                                Detail Pendaftar
                            </h2>

                            {{-- DETAIL --}}
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <template x-if="data">
                                    <div class="col-span-2 grid grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-gray-500">Nama Lengkap</p>
                                            <p class="font-medium" x-text="data.nama_lengkap"></p>
                                        </div>

                                        <div>
                                            <p class="text-gray-500">NISN</p>
                                            <p class="font-medium" x-text="data.nisn ?? '-'"></p>
                                        </div>

                                        <div>
                                            <p class="text-gray-500">NIK</p>
                                            <p class="font-medium" x-text="data.nik ?? '-'"></p>
                                        </div>

                                        <div>
                                            <p class="text-gray-500">Jenis Kelamin</p>
                                            <p class="font-medium" x-text="data.jenis_kelamin ?? '-'"></p>
                                        </div>

                                        <div>
                                            <p class="text-gray-500">Tanggal Lahir</p>
                                            <p class="font-medium"
                                            x-text="data.tanggal_lahir
                                                    ? new Date(data.tanggal_lahir).toLocaleDateString('id-ID')
                                                    : '-'">
                                            </p>
                                        </div>

                                        <div>
                                            <p class="text-gray-500">No HP</p>
                                            <p class="font-medium" x-text="data.no_hp ?? '-'"></p>
                                        </div>

                                        <div class="md:col-span-2">
                                            <p class="text-gray-500">Alamat</p>
                                            <p class="font-medium whitespace-pre-line"
                                            x-text="data.alamat ?? '-'"></p>
                                        </div>

                                        <div>
                                            <p class="text-gray-500">Sekolah Asal</p>
                                            <p class="font-medium" x-text="data.sekolah_asal ?? '-'"></p>
                                        </div>

                                        <div>
                                            <p class="text-gray-500">Jurusan</p>
                                            <p class="font-medium" x-text="data.jurusan"></p>
                                        </div>

                                        <div>
                                            <p class="text-gray-500">Status Pendaftaran</p>
                                            <span
                                                class="inline-block mt-1 px-3 py-1 rounded-full text-xs font-semibold"
                                                :class="{
                                                    'bg-gray-200 text-gray-700': data.status_pendaftaran === 'draft',
                                                    'bg-blue-200 text-blue-700': data.status_pendaftaran === 'dikirim',
                                                    'bg-green-200 text-green-700': data.status_pendaftaran === 'diterima',
                                                    'bg-red-200 text-red-700': data.status_pendaftaran === 'ditolak'
                                                }"
                                                x-text="data.status_pendaftaran">
                                            </span>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            {{-- ACTION --}}
                            <div class="mt-8 flex justify-end gap-3">
                                <button
                                    @click="open = false"
                                    class="px-4 py-2 rounded-lg border text-sm">
                                    Tutup
                                </button>

                                <form :action="`/admin/pendaftaran/${data?.id_pendaftar}/tolak`" method="POST">
                                    @csrf
                                    <button class="px-4 py-2 rounded-lg bg-red-600 text-white text-sm">
                                        Tolak
                                    </button>
                                </form>

                                <form :action="`/admin/pendaftaran/${data?.id_pendaftar}/verifikasi`" method="POST">
                                    @csrf
                                    <button class="px-4 py-2 rounded-lg bg-green-600 text-white text-sm">
                                        Terima
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                </div>
                {{--pagination--}}
                <div class="mt-4
                    [&_.pagination]:text-white
                    [&_a]:text-white
                    [&_span]:text-white
                    [&_svg]:text-white
                    [&_.bg-white]:bg-transparent
                    [&_.border-gray-300]:border-white/30">
                    {{ $pendaftar->links() }}
                </div>
        </div>
    </div>
@endsection
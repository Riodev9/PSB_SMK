@extends('layouts.halaman')

@section('content')
<div class="space-y-6 p-4 my-8 bg-slate-900/65 rounded-xl">
    {{--pendaftaran--}}
    <div class="bg-slate-800 rounded-xl shadow p-6">
        <h2 class="text-lg text-white font-semibold mb-6">
            Buka Pendaftaran Tahun Ajaran
        </h2>

        <form action="{{ route('admin.tahun_ajaran.store') }}"
              method="POST"
              class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @csrf

            {{-- Tahun Ajaran (DATE) --}}
            <input type="date"
                   name="tahun"
                   class="border rounded-lg px-4 py-2"
                   required>

            {{-- Kuota --}}
            <input type="number"
                   name="kuota"
                   min="1"
                   placeholder="Kuota"
                   class="border rounded-lg px-4 py-2"
                   required>

            <button type="submit"
                    class="bg-blue-600 text-white rounded-lg px-4 py-2 hover:bg-blue-700">
                Buka Pendaftaran
            </button>
        </form>
    </div>

    {{-- FILTER & STATUS --}}
    <div class="flex border-collapse flex-wrap items-center justify-between gap-4">

        {{-- Filter Tahun --}}
        <form method="GET">
            <select name="tahun"
                    onchange="this.form.submit()"
                    class="border rounded-lg px-4 py-2">
                <option value="">Semua Tahun</option>
                @foreach($tahunList as $t)
                    <option value="{{ $t->id_tahun }}"
                        {{ $tahunDipilih == $t->id_tahun ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::parse($t->tahun)->format('Y') }}
                        {{ $t->is_active ? '(Aktif)' : '' }}
                    </option>
                @endforeach
            </select>
        </form>

        {{-- Status Aktif --}}
        @if($tahunAktif)
            <span class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-700">
                Pendaftaran Dibuka
                ({{ \Carbon\Carbon::parse($tahunAktif->tahun)->format('Y') }})
            </span>
        @else
            <span class="px-3 py-1 text-sm rounded-full bg-red-100 text-red-700">
                Tidak ada pendaftaran aktif
            </span>
        @endif
    </div>

    {{--aksesoris--}}
    <form method="GET" class="flex flex-wrap gap-3 mb-4">
        <input type="text"
            name="q"
            value="{{ request('q') }}"
            placeholder="Cari nama / NISN / sekolah"
            class="border rounded-lg px-2 py-2">

        <select name="perpage"
                onchange="this.form.submit()"
                class="border rounded-lg w-16 px-4 py-2">
            @foreach([10,25,50] as $n)
                <option value="{{ $n }}" @selected(request('perpage')==$n)>
                    {{ $n }}
                </option>
            @endforeach
        </select>

        <input type="hidden" name="tahun" value="{{ $tahunDipilih }}">
    </form>

    {{-- TABEL PENDAFTAR --}}
    <div class="bg-slate-800 rounded-xl overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="text-left text-white font-inter">
                <tr>
                    <th class="p-3">No</th>
                    <th class="p-3">Nama</th>
                    <th class="p-3">NISN</th>
                    <th class="p-3">Sekolah Asal</th>
                    <th class="p-3">Tahun</th>
                    <th class="p-3">Status</th>
                </tr>
            </thead>
            <tbody class="text-white font-inter">
                @forelse($pendaftar as $i => $p)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-3">{{ $i + 1 }}</td>
                        <td class="p-3 font-medium">{{ $p->nama_lengkap }}</td>
                        <td class="p-3">{{ $p->nisn }}</td>
                        <td class="p-3">{{ $p->sekolah_asal }}</td>
                        <td class="p-3">
                            {{ \Carbon\Carbon::parse($p->tahunAjaran->tahun)->format('Y') }}
                        </td>
                        <td class="p-3">
                            <span class="px-2 py-1 rounded text-xs font-medium
                                @class([
                                    'bg-gray-200 text-gray-700' => $p->status_pendaftaran === 'draft',
                                    'bg-blue-200 text-blue-700' => $p->status_pendaftaran === 'dikirim',
                                    'bg-green-200 text-green-700' => $p->status_pendaftaran === 'diterima',
                                    'bg-red-200 text-red-700' => $p->status_pendaftaran === 'ditolak',
                                ])">
                                {{ ucfirst($p->status_pendaftaran) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6"
                            class="p-6 text-center text-gray-500">
                            Belum ada pendaftar
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $pendaftar->links('pagination::tailwind') }}
        </div>
    </div>

</div>
@endsection

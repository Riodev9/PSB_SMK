<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    public function index(Request $request)
    {
        $tahunList = TahunAjaran::orderByDesc('tahun')->get();
        $tahunAktif = TahunAjaran::where('is_active', true)->first();

        $tahunDipilih = $request->tahun ?? optional($tahunAktif)->id_tahun;
        $perPage = $request->perpage ?? 10;

        $pendaftar = Pendaftar::with('tahunAjaran')
            ->when($tahunDipilih, fn ($q) =>
                $q->where('id_tahun', $tahunDipilih)
            )
            ->when($request->q, function ($q) use ($request) {
                $q->where('nama_lengkap', 'like', "%{$request->q}%")
                ->orWhere('nisn', 'like', "%{$request->q}%")
                ->orWhere('sekolah_asal', 'like', "%{$request->q}%");
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.tahun_ajaran', compact(
            'tahunList',
            'tahunAktif',
            'tahunDipilih',
            'pendaftar'
        ));
    }
    /**
     * BUKA PENDAFTARAN
     */
    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|date|unique:tahun_ajaran,tahun',
            'kuota' => 'required|integer|min:1',
        ]);

        // pastikan cuma 1 tahun aktif
        TahunAjaran::where('is_active', true)->update(['is_active' => false]);

        TahunAjaran::create([
            'tahun' => $request->tahun,
            'kuota' => $request->kuota,
            'is_active' => true,
        ]);

        return back()->with('success', 'Pendaftaran berhasil dibuka');
    }

    /**
     * TUTUP PENDAFTARAN
     */
    public function close($id)
    {
        $tahun = TahunAjaran::findOrFail($id);

        $tahun->update([
            'is_active' => false
        ]);

        return back()->with('success', 'Pendaftaran berhasil ditutup');
    }
}

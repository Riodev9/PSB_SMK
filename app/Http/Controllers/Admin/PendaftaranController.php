<?php

namespace App\Http\Controllers\Admin;

use App\Models\TahunAjaran;
use App\Models\Pendaftar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $tahunAktif = TahunAjaran::where('is_active', true)->first();

        $perPage = $request->get('per_page', 10);
        $search  = $request->get('q');

        $pendaftar = Pendaftar::with('tahunAjaran')
            ->when($tahunAktif, fn ($q) =>
                $q->where('id_tahun', $tahunAktif->id_tahun)
            )
            ->when($search, function ($q) use ($search) {
                $q->where(function ($qq) use ($search) {
                    $qq->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('jurusan', 'like', "%{$search}%")
                    ->orWhere('status_pendaftaran', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.pendaftaran', compact(
            'tahunAktif',
            'pendaftar'
        ));
    }

    public function verifikasi($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->update([
            'status_pendaftaran' => 'diterima',
        ]);
        
        return back()->with('success', 'Pendaftar diterima');
    }
    public function tolak($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);

        $pendaftar->update([
            'status_pendaftaran' => 'ditolak',
        ]);

        return back()->with('success', 'Pendaftar ditolak');
    }

}

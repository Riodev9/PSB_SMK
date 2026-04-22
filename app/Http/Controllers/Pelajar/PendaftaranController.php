<?php

namespace App\Http\Controllers\Pelajar;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaran;
use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        //pendaftar.id = id
        $pendaftar = Pendaftar::where('id', $user->id)->first();

        $tahunAktif = TahunAjaran::where('is_active', true)->first();

        return view('pelajar.pendaftaran_pelajar', compact(
            'pendaftar',
            'tahunAktif'
        ));
    }

    public function daftar(Request $request)
    {
        $request->validate([
            'jurusan' => 'required|in:TKJ (Teknik Komputer dan Jaringan),MM (Multimedia),OTKP (Otomatisasi Tata Kelola Perkantoran)',
            'ijazah' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5000',
            'kk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5000',
        ]);

        $tahunAktif = TahunAjaran::where('is_active', true)->firstOrFail();
        $pendaftar  = Pendaftar::where('id', Auth::id())->first();

        // WAJIB ISI DATA DIRI
        if (!$pendaftar) {
            return redirect()
                ->route('pelajar.pendaftaran_pelajar')
                ->with('error', 'Silakan lengkapi data diri terlebih dahulu.');
        }

        // CEK KUOTA
        if ($tahunAktif->kuota <= 0) {
            return redirect()
                ->route('pelajar.pendaftaran_pelajar')
                ->with('error', 'Pendaftaran ditutup, kuota sudah habis.');
        }

        // CEGAH DAFTAR ULANG
        if (!in_array($pendaftar->status_pendaftaran, [null, 'draft'])) {
            return redirect()
                ->route('pelajar.pendaftaran_pelajar')
                ->with('error', 'Anda sudah mendaftar.');
        }

        // Upload Ijazah
        if ($request->hasFile('ijazah')) {
            $file = $request->file('ijazah')->store('berkas', 'public');
            \App\Models\Berkas::updateOrCreate(
                ['id_pendaftar' => $pendaftar->id_pendaftar, 'jenis_file' => 'Ijazah/SKL'],
                ['file_path' => $file, 'status_berkas' => 'dikirim']
            );
        }

        // Upload KK
        if ($request->hasFile('kk')) {
            $file = $request->file('kk')->store('berkas', 'public');
            \App\Models\Berkas::updateOrCreate(
                ['id_pendaftar' => $pendaftar->id_pendaftar, 'jenis_file' => 'KK'],
                ['file_path' => $file, 'status_berkas' => 'dikirim']
            );
        }

        // UPDATE STATUS
        $pendaftar->update([
            'id_tahun' => $tahunAktif->id_tahun,
            'jurusan' => $request->jurusan,
            'status_pendaftaran' => 'dikirim',
        ]);

        // KURANGI KUOTA
        $tahunAktif->decrement('kuota');

        return redirect()
            ->route('pelajar.pendaftaran_pelajar')
            ->with('success', 'Pendaftaran berhasil dikirim');
    }
}
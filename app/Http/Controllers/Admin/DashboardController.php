<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaran;
use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
   public function index()
    {
        // ambil tahun ajaran aktif
    $tahunAktif = TahunAjaran::where('is_active', true)->first();

    // hitung peserta yang sedang mendaftar
    $jumlahPeserta = 0;

    if ($tahunAktif) {
        $jumlahPeserta = Pendaftar::where('id_tahun', $tahunAktif->id_tahun)
            ->whereIn('status_pendaftaran', ['draft', 'dikirim'])
            ->count();
    }

        Carbon::setLocale('id');

        $tanggalHari = Carbon::now()->translatedFormat('l, d F Y');

        return view('admin.dashboard', compact(
            'jumlahPeserta',
            'tanggalHari',
            'tahunAktif'
        ));
    }
}

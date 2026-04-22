<?php

namespace App\Http\Controllers\Pelajar;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use App\Models\Pendaftar;
use Illuminate\Support\Facades\Auth;

class InformasiController extends Controller
{
    public function index()
    {
        // ambil tahun ajaran yang sedang aktif
        $tahunAktif = \App\Models\TahunAjaran::where('is_active', true)->first();

        if (!$tahunAktif) {
            $informasi = collect();
        } else {
            $informasi = Informasi::where('id_tahun', $tahunAktif->id_tahun)
                ->orderByDesc('created_at')
                ->get();
        }

        return view('pelajar.informasi', compact('informasi'));
    }
}

<?php

namespace App\Http\Controllers\Pelajar;

use App\Models\Pendaftar;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataDiriController extends Controller
{
    public function index()
    {
        $tahunAktif = TahunAjaran::where('is_active', true)->firstOrFail();

        $pendaftar = Pendaftar::where('id', Auth::id())->first();

        return view('pelajar.data_diri', compact('pendaftar', 'tahunAktif'));
    }
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'nama_lengkap' => 'required',
            'nisn' => 'required|digits:10',
            'nik' => 'required|digits:16',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'no_hp' => 'required',
            'sekolah_asal' => 'required',
        ]);

        $tahunAktif = TahunAjaran::where('is_active', true)->firstOrFail();

        Pendaftar::updateOrCreate(
            ['id' => Auth::id()],
            array_merge($request->all(), [
                'tahun_ajaran_id' => $tahunAktif->id_tahun,
                'status_pendaftaran' => 'draft'
            ])
        );

        return back()->with('success', 'Data diri berhasil disimpan');
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    public function index(Request $request)
    {
        // ambil semua tahun ajaran (desc)
        $tahunAjaran = TahunAjaran::orderByDesc('tahun')->get();

        // tahun terpilih (GET) atau default tahun terbaru
        $tahunId = $request->tahun_ajaran_id ?? $tahunAjaran->first()?->id_tahun;

        // ambil informasi berdasarkan tahun ajaran
        $informasi = Informasi::where('id_tahun', $tahunId)
            ->orderByDesc('created_at')
            ->get();

        return view('admin.informasi', compact(
            'informasi',
            'tahunAjaran',
            'tahunId'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_tahun' => 'required',
            'judul'    => 'required|string|max:255',
            'isi'      => 'required|string',
        ]);

        Informasi::create($request->only('id_tahun', 'judul', 'isi'));

        return back()->with('success', 'Informasi ditambahkan');
    }

    public function destroy($id)
    {
        Informasi::where('id_informasi', $id)->delete();
        return back()->with('success', 'Informasi dihapus');
    }
}

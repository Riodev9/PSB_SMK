<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class BerkasController extends Controller
{
   public function index(Request $request)
    {
        $tahunAjarans = TahunAjaran::orderByDesc('tahun')->get();

        $tahunId = $request->tahun_ajaran_id ?? $tahunAjarans->first()?->id_tahun;
        $tahun   = TahunAjaran::find($tahunId);

        $perPage = $request->perpage ?? 10;

        $pendaftars = Pendaftar::with(['berkas', 'user'])
            ->where('id_tahun', $tahunId)
            ->when($request->q, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('nama_lengkap', 'like', '%' . $request->q . '%')
                    ->orWhere('nisn', 'like', '%' . $request->q . '%');
                });
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.berkas', compact(
            'pendaftars',
            'tahunAjarans',
            'tahunId',
            'tahun'
        ));
    }


    public function updateCatatan(Request $request, $id_pendaftar)
    {
        $request->validate(['catatan' => 'nullable|string|max:255']);

        $pendaftar = Pendaftar::findOrFail($id_pendaftar);

        foreach ($pendaftar->berkas as $berkas) {
            $berkas->catatan = $request->catatan;
            $berkas->save();
        }

        return back()->with('success', 'Catatan berhasil diperbarui');
    }
}

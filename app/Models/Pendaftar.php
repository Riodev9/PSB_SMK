<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    use HasFactory;

    protected $table = 'pendaftar';
    protected $primaryKey = 'id_pendaftar';

    protected $fillable = [
        'id',
        'id_tahun',
        'nisn',
        'nik',
        'nama_lengkap',
        'jenis_kelamin',
        'tanggal_lahir',
        'no_hp',
        'alamat',
        'sekolah_asal',
        'status_pendaftaran',
        'jurusan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahun', 'id_tahun');
    }

    public function berkas()
    {
        return $this->hasMany(Berkas::class, 'id_pendaftar', 'id_pendaftar');
    }
}

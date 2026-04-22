<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    use HasFactory;

    protected $table = 'berkas';
    protected $primaryKey = 'id_berkas';

    protected $fillable = [
        'id_pendaftar',
        'file_path',
        'status_berkas',
        'catatan',
        'jenis_file',
    ];

    public function pendaftar()
    {
        return $this->belongsTo(Pendaftar::class, 'id_pendaftar', 'id_pendaftar');
    }

    public function isIjazah()
    {
        return $this->jenis_file === 'Ijazah/SKL';
    }

    public function isKK()
    {
        return $this->jenis_file === 'kk';
    }
}

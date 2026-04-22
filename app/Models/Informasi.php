<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Informasi extends Model
{
    protected $table = 'informasi';
    protected $primaryKey = 'id_informasi';

    protected $fillable = [
        'id_tahun',
        'judul',
        'isi',
    ];
    
    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahun', 'id_tahun');
    }
}

    


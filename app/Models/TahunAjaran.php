<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;

    protected $table = 'tahun_ajaran';
    protected $primaryKey = 'id_tahun';

    protected $fillable = [
        'tahun',
        'kuota',
        'is_active',
    ];
    protected $casts = [
        'tahun' => 'date',
    ];

    public function pendaftar()
    {
        return $this->hasMany(Pendaftar::class, 'id_tahun', 'id_tahun');
    }
    
    public function informasis()
    {
        return $this->hasMany(Informasi::class, 'id_tahun', 'id_tahun');
    }

}

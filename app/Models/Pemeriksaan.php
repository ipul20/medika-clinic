<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    protected $table = 'pemeriksaan';
    protected $fillable = [
        'tanggal',
        'pasien_id',
        'keluhan',
        'diagnosa',
        'dokter_id',
        'poli_id',
    ];
    public function resep()
    {
        return $this->hasMany(Resep::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }
}

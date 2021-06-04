<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'dokter';
    protected $fillable = [
        'nip',
        'nama',
        'jenis_kelamin',
        'nohp',
        'alamat',
        'poli_id',
        'user_id',
        'status',
    ];

    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
    public function pemeriksaan()
    {
        return $this->hasMany(Pemeriksaan::class);
    }
}

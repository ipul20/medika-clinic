<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $fillable = [
        'dokter_id',
        'sesi',
        'mulai',
        'selesai',
    ];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
}

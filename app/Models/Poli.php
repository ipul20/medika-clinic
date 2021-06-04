<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    protected $table = 'poli';
    protected $fillable = [
        'nama',
    ];

    public function dokter()
    {
        return $this->hasMany(Dokter::class);
    }
}

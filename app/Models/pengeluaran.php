<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $fillable = [
        'bendahara_id',
        'nama_kegiatan',
        'tanggal',
        'jumlah',
        'keterangan',
    ];

    // Relasi ke User (bendahara)
    public function bendahara()
    {
        return $this->belongsTo(\App\Models\Bendahara::class);
    }
}

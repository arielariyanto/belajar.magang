<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model // ✅ Awalan huruf besar!
{
    protected $table = 'siswas'; // ✅ Nama tabel sesuai migration

    protected $fillable = ['nisn', 'nama', 'kelas', 'jurusan'];

    public function getLabelAttribute()
    {
        return "{$this->nisn} - {$this->nama}";
    }
}

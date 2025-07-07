<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bendahara extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_bendahara', 
        'kelas',
        'siswa_id',
        'jumlah'];

       public function siswas()
{
    return $this->belongsTo(Siswa::class);
}
}


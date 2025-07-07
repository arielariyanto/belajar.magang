<?php

namespace App\Filament\Resources\BendaharaResource\Pages;

use App\Filament\Resources\BendaharaResource;
use App\Models\Bendahara;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateBendahara extends CreateRecord
{
    protected static string $resource = BendaharaResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        // Simpan semua data langsung ke tabel bendaharas
        return Bendahara::create([
            'nama_bendahara' => $data['nama_bendahara'],
            'kelas' => $data['kelas'],
            'siswa_id' => $data['siswa_id'],
            'jumlah' => $data['jumlah'],
        ]);
    }
}

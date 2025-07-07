<?php

namespace App\Filament\Resources\SiswaResource\Pages;

use App\Filament\Resources\SiswaResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateSiswa extends CreateRecord
{
    protected static string $resource = SiswaResource::class;

    // 🔁 Redirect ke halaman index setelah create
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // ✅ Tampilkan notifikasi berhasil
    protected function afterCreate(): void
    {
        Notification::make()
            ->title('Siswa berhasil ditambahkan!')
            ->success()
            ->send();
    }
}

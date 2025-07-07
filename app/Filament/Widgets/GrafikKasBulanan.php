<?php

namespace App\Filament\Widgets;

use App\Models\Bendahara;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class GrafikKasBulanan extends ChartWidget
{
    protected static ?string $heading = '📊 Grafik Total Kas per Bulan';
    protected static ?int $sort = 1;

    protected function getData(): array
    {
        // Ambil total kas per bulan untuk tahun berjalan
        $tahunIni = now()->year;

        $data = Bendahara::selectRaw('MONTH(created_at) as bulan, SUM(jumlah) as total')
            ->whereYear('created_at', $tahunIni)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        $labels = [];
        $values = [];

        for ($i = 1; $i <= 12; $i++) {
            $labels[] = \Carbon\Carbon::create()->month($i)->format('F'); // Nama bulan (e.g., January)
            $values[] = $data[$i] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Kas ' . $tahunIni . ' (Rp)',
                    'data' => $values,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.6)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // Bisa diubah ke 'line' kalau mau garis
    }
}

<?php

namespace App\Filament\Widgets;

use App\Models\Information;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class InformationChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Informasi/Dokumen Per Bulan';

    protected static ?int $sort = 3;

    public ?string $filter = null;

    protected function getData(): array
    {
        // Get selected year or default to current year
        $year = $this->filter ?? now()->year;

        // Initialize array with 12 months
        $months = [
            'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
            'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
        ];

        $data = [];

        // Query information count for each month
        for ($month = 1; $month <= 12; $month++) {
            $count = Information::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->count();

            $data[] = $count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Informasi & Dokumen',
                    'data' => $data,
                    'backgroundColor' => '#3b82f6',
                    'borderColor' => '#2563eb',
                ],
            ],
            'labels' => $months,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getFilters(): ?array
    {
        $currentYear = now()->year;
        $years = [];

        // Generate last 5 years including current year
        for ($i = 0; $i < 5; $i++) {
            $year = $currentYear - $i;
            $years[$year] = (string) $year;
        }

        return $years;
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                ],
            ],
        ];
    }
}

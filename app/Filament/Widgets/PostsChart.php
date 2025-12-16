<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class PostsChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Artikel Per Bulan';

    protected static ?int $sort = 2;

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

        // Query posts count for each month
        for ($month = 1; $month <= 12; $month++) {
            $count = Post::whereYear('publish_at', $year)
                ->whereMonth('publish_at', $month)
                ->count();

            $data[] = $count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Artikel Berita',
                    'data' => $data,
                    'backgroundColor' => '#059669',
                    'borderColor' => '#047857',
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

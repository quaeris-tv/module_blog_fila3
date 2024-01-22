<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Article;

use Filament\Widgets\ChartWidget;

class TestChart extends ChartWidget
{
    protected static ?string $heading = 'Test Graph';

    protected function getData(): array
    {
        dddx('aaa');

        return [
            'datasets' => [
                [
                    'label' => 'Test Graph created',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

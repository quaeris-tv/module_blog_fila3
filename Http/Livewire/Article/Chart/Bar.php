<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Article\Chart;

use Filament\Widgets\ChartWidget;
use Modules\Blog\Models\Article;

class Bar extends ChartWidget
{
    public Article $model;

    public array $data;

    protected static ?string $heading = 'Forecast Volume';

    protected function getData(): array
    {
        $chart_data = [];
        $orders = $this->model->orders;
        $ratings = $this->model->getOptionRatingsIdTitle();
        $ratings_color = $this->model->getOptionRatingsIdColor();
        $data = [];

        foreach (array_keys($ratings) as $key) {
            $tmp = $orders->where('rating_id', $key);
            $data['data'][] = $tmp->sum('credits');
            $data['backgroundColor'][] = $ratings_color[$key];
            $data['borderColor'][] = $ratings_color[$key];

            $chart_data['labels'][] = $ratings[$key];
        }
        // $data['label'] = 'Volume';

        $chart_data['datasets'][] = $data;

        // dddx([
        //     $chart_data,
        //     [
        //         'datasets' => [
        //             [
        //                 'data' => [3, 10, 5],
        //                 'label' => 'volume',
        //                 'backgroundColor' => ['#ffff', '#aaaa', '#23c713'],
        //                 'borderColor' => ['#ffff', '#aaaa', '#23c713'],
        //             ],
        //         ],
        //         'labels' => ['option1', 'option2', 'option3'],
        //     ]
        // ]);

        return $chart_data;

        // return             [
        //     'datasets' => [
        //         [
        //             'data' => [3, 10, 5],
        //             'label' => 'volume',
        //             'backgroundColor' => ['#ffff', '#aaaa', '#23c713'],
        //             'borderColor' => ['#ffff', '#aaaa', '#23c713'],
        //         ],
        //     ],
        //     'labels' => ['option1', 'option2', 'option3'],
        // ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'indexAxis' => 'y',
            'plugins' => [
                'legend' => [
                    'display' => false,
                    // labels: [
                    //     color: 'rgb(255, 99, 132)'
                    // ]
                ],
            ],
        ];
    }
}

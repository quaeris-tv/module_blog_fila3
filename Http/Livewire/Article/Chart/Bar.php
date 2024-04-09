<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Article\Chart;

use Filament\Widgets\ChartWidget;
use Modules\Blog\Models\Article;

class Bar extends ChartWidget
{
    protected static ?string $heading = 'Blog Posts Bar';

    public Article $model;
    public array $data;

    protected function getData(): array
    {
        $chart_data = [];
        $orders = $this->model->orders;
        $ratings = $this->model->getOptionRatingsIdTitle();
        $ratings_color = $this->model->getOptionRatingsIdColor();
        // dddx($orders->groupBy('rating_id'));

        $data = [];
        foreach ($orders->groupBy('rating_id') as $key => $group) {
            // dddx([$key, $group]);
            $sum = 0;
            foreach ($group as $rating) {
                $sum += $rating->credits;
            }

            $data[] = $sum;

            // $data[] = $sum;
            $chart_data['labels'][] = $ratings[$key];
            $chart_data['datasets']['label'] = $ratings[$key];

            // $chart_data['datasets'][]['backgroundColor'] = $ratings_color[$key];
            // $chart_data['datasets'][]['borderColor'] = $ratings_color[$key];

            // dddx([
            //     $ratings,
            //     $rating
            // ]);
        }
        $chart_data['datasets'][]['data'] = $data;

        // dddx([
        //     $chart_data,
        //     [
        //         'datasets' => [
        //             [
        //                 'data' => [3, 10],
        //             ],
        //         ],
        //         'labels' => ['yes', 'no'],
        //     ]

        // ]);

        // return $chart_data;

        return [
            'datasets' => [
                [
                    'data' => [3, 10],
                ],
            ],
            'labels' => ['yes', 'no'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'indexAxis' => 'y',
        ];
    }
}

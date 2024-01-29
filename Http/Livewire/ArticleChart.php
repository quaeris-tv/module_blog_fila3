<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire;

use Illuminate\Support\Arr;
use Modules\Blog\Models\Order;
use Filament\Widgets\ChartWidget;

class ArticleChart extends ChartWidget
{
    protected static ?string $heading = 'Blog Posts';

    public string $type_chart;
    public string $article_id;
    // public array $ratingOptions;

    protected function getData(): array
    {
        // dddx($this->ratingOptions);
        $data = Order::where('article_id', $this->article_id)
            ->get()
            ->sortBy('date')
            // ->toArray()
            // ->groupBy('date')
            // ->map(function($value){
            //     dddx($value);
            // })
            ;

        $labels = Arr::pluck($data->toArray(), 'date');
        dddx($labels);

        // dddx($data->where('rating_id', 11)->get()->toArray());

        $opt1 = Arr::pluck($data->where('rating_id', 11)->get()->toArray(), 'bet_credits');
        dddx($opt1);
        // dddx($data);




        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                ],
                [
                    'label' => 'Blog posts createddddddd',
                    'data' => [0, 2, 15, 10, 29, 42, 55, 25, 47, 88],
                ],
            ],
            // 'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'labels' => $labels
        ];
    }

    protected function getType(): string
    {
        return $this->type_chart;
    }
}

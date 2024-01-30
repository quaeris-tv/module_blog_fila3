<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire;

use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Modules\Blog\Models\Article;

class ArticleChart extends ChartWidget
{
    protected static ?string $heading = 'Blog Posts';

    public Article $model;
    public array $data;

    public ?string $filter = '-7';

    protected function getData(): array
    {
        $activeFilter = $this->filter;
        $orders = $this->model->orders;
        $ratings = $this->model->getOptionRatingsIdTitle();

        $data = [];
        for ($i = $activeFilter + 1; $i <= 0; ++$i) {
            $date = Carbon::now()->addDays($i);
            $key = $date->format('Y-m-d');
            $tmp = [
                'date' => $date,
                'key' => $key,
                'label' => $date->format('d/m/Y'),
            ];
            $tmp1 = [];
            foreach ($ratings as $rating_id => $rating_title) {
                $tmp1[] = [
                    'rating_id' => $rating_id,
                    'rating_title' => $rating_title,
                    'value' => $orders
                        ->where('date', $key)
                        ->where('rating_id', $rating_id)
                        ->first()?->credits ?? 0,
                ];
            }
            $tmp['ratings'] = $tmp1;
            $data[] = $tmp;
        }

        $data_chart = [];

        $data_chart['labels'] = collect($data)->pluck('label')->toArray();
        $data_chart['datasets'] = [];
        foreach ($ratings as $rating_id => $rating_title) {
            $data_chart['datasets'][] = [
                'label' => $rating_title,
                'data' => collect($data)->map(function ($item) use ($rating_id) {
                    return collect($item['ratings'])->firstWhere('rating_id', $rating_id)['value'];
                })->toArray(),
            ];
        }

        return $data_chart;
    }

    protected function getType(): string
    {
        return $this->data['chart_type'];
    }

    protected function getFilters(): ?array
    {
        return [
            '-1' => 'Ultimo Giorno',
            '-7' => 'Ultima Settimana',
            '-30' => 'Ultimo Mese',
            '-90' => 'Ultimi 3 Mesi',
            '-180' => 'Ultimi 6 Mesi',
        ];
    }
}

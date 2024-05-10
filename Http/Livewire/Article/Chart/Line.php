<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Article\Chart;

use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Modules\Blog\Datas\RatingInfoData;
use Modules\Blog\Models\Article;
use Webmozart\Assert\Assert;

class Line extends ChartWidget
{
    protected static ?string $heading = 'Daily Forecasts';

    public Article $model;
    public array $data;

    public ?string $filter = '-7';

    protected function getData(): array
    {
        $activeFilter = $this->filter;
        $orders = $this->model->orders;
        $ratings = $this->model->getOptionRatingsIdTitle();
        $ratings_color = $this->model->getOptionRatingsIdColor();

        $data = [];
        for ($i = $activeFilter++; $i <= 0; ++$i) {
            $date = Carbon::now()->addDays((int) $i);
            $key = $date->format('Y-m-d');
            $tmp = [
                'date' => $date,
                'key' => $key,
                'label' => $date->format('d/m/Y'),
            ];
            $tmp1 = [];
            foreach ($ratings as $rating_id => $rating_title) {
                $tmp1[] = RatingInfoData::from([
                    'ratingId' => $rating_id,
                    'title' => $rating_title,
                    'credit' => $orders
                        ->where('date', $key)
                        ->where('rating_id', $rating_id)
                        ->first()?->credits ?? 0,
                ]);
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
                    Assert::notNull($rating_info = collect($item['ratings'])->firstWhere('ratingId', $rating_id), '['.__LINE__.']['.__FILE__.']');

                    return $rating_info->credit;
                })->toArray(),
                'backgroundColor' => $ratings_color[$rating_id],
                'borderColor' => $ratings_color[$rating_id],
            ];
        }

        return $data_chart;
    }

    protected function getType(): string
    {
        return 'line';
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

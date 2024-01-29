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
    public string $model_id;
    public string $model_type;
    public array $optionsRatingsIdTitle;
    public array $datasets = [];

    public ?string $filter = '-7';

    protected function getData(): array
    {
        $activeFilter = $this->filter;

        $data_article = Order::where('model_id', $this->model_id)
            ->where('model_type', $this->model_type)
            ->get()
            ->sortBy('date')
            ->take($activeFilter)
            // ->toArray()
            // ->groupBy('date')
            // ->map(function($value){
            //     dddx($value);
            // })
            ;

        $labels = [];

        $tmp_labels = array_unique(Arr::pluck($data_article->toArray(), 'date'));
        foreach($tmp_labels as $lbl){
            $labels[] = $lbl;
        }

        $data_chart = [];

        foreach($this->optionsRatingsIdTitle as $key => $opt){
            $data_options = $data_article->where('rating_id', $key);
            $tmp = [];
            foreach($labels as $date){
                $data_option = $data_options->where('date', $date)->first();
                if($data_option == null){
                    $tmp[] = 0;
                }else{
                    $tmp[] = $data_option->bet_credits;
                }
            }
            $data_chart['datasets'][] = ['label' => $opt, 'data' => $tmp];
        }

        $data_chart['labels'] = $labels;

        return $data_chart;
    }

    protected function getType(): string
    {
        return $this->type_chart;
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

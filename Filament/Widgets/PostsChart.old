<?php

namespace Modules\Blog\Filament\Widgets;

use Filament\Widgets\LineChartWidget;
use Illuminate\Contracts\Support\Htmlable;

class PostsChart extends LineChartWidget
{
    protected string | Htmlable $label;

    final public function __construct(string | Htmlable $label)
    {
        //$this->label($label);
        //$this->value($value);
        $this->label=$label;
    }

    public static function make(string | Htmlable $label): static
    {
        return app(static::class, ['label' => $label]);
    }

    protected function getHeading(): string
    {
        return 'Blog posts';
    }

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }
}

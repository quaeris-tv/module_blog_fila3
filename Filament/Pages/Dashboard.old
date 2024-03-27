<?php

namespace Modules\Blog\Filament\Pages;

use Filament\Pages\Dashboard as BasePage;
use Illuminate\Contracts\Support\Htmlable;

use Filament\Widgets\StatsOverviewWidget\Card;
use Modules\Blog\Filament\Widgets\AdminWidgets;
use Modules\Blog\Filament\Widgets\PostsChart;

class Dashboard extends BasePage
{
    protected int | string | array $columnSpan = [
        'md' => 2,
        'xl' => 3,
    ];

    protected function getSubheading(): string | Htmlable | null
    {
        return 'Here you will see an overview of your tasks.';
    }

    protected function getWidgets(): array
    {

        return [
             //AdminWidgets::class,
             //PostsChart::class,
        ];
    }
}

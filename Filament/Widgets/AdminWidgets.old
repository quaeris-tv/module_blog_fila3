<?php

namespace Modules\Blog\Filament\Widgets;

use Modules\User\Models\User;
use Modules\Blog\Filament\Widgets\PostsChart;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class AdminWidgets extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getCards(): array
    {
        return [
            Card::make('Total Users', User::count()),
            Card::make('Users Registered Today', User::whereDate('created_at', today())->count()),

            //new PostsChart('aa'),
            //PostsChart::make('aa'),
            //PostsChart::class,
            //Card::make('Tasks Created Today', PostsChart::make('aa')),
        ];
    }

    /*
    public static function canView(): bool
    {
        return auth()->user()->is_admin;
    }
    */
}
